<?php
namespace DiscountTypes;

use DiscountItems\CombinationItem;


class CombinationDiscount extends AbstractDiscountType
{
    protected $discountItem;

    public function __construct(CombinationItem $discountItem)
    {
        $this->discountItem = $discountItem;
    }

    public function getHash()
    {
        $products = $this->discountItem->getProducts();
        sort($products);
        return implode('', $products);
    }

    public function countSum()
    {
        $sum = 0;
        if($this->isAllowed()){
            $product = $this->product;
            $order = $product->getOrder();
            $products = $this->discountItem->getProducts();

            foreach ($order as $k => &$v) {
                if(!in_array($k, $products)){
                    unset($order[$k]);
                }
            }unset($k,$v);


            $min = min($order);

            $price = 0;
            foreach($products as $type){
                $price += $product->getPrice($type);
                $product->decreaseOrderAmount($type, $min);
            }unset($type);

            $discount = $this->discountItem->getDiscount();
            $price = $price - $price * $discount / 100;
            $price = floor($price * 100) / 100;
            $sum = $min * $price;

//			echo __CLASS__.': '.implode(' ', array_keys($order)).' - '.$sum .PHP_EOL;
        }
        return $sum;
    }


	protected function isAllowed()
    {
        $order = $this->product->getOrder();
        foreach($this->discountItem->getProducts() as $type){
            if(!array_key_exists($type, $order)){
                return false;
            }
        }unset($type);
        return true;
    }
}