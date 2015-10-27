<?php
namespace DiscountTypes;

use DiscountItems\ConditionItem;

class ConditionDiscount extends AbstractDiscountType
{
    protected $discountItem;

    public function __construct(ConditionItem $discountItem)
    {
        $this->discountItem = $discountItem;
    }

    public function getHash()
    {
        $additionalProducts = $this->discountItem->getAdditionalProducts();
        sort($additionalProducts);
        return $this->discountItem->getProduct() . implode('', $additionalProducts);
    }

    public function countSum()
    {
        $sum = 0;
        if($this->isAllowed()){

			// note Discount for main product
			$product = $this->product;
			$discountedProduct = $this->discountItem->getProduct();
			$order = $product->getOrder();

			$amount = $order[$discountedProduct];

			$price = 0;
			$price += $product->getPrice($discountedProduct);
			$product->decreaseOrderAmount($discountedProduct, $amount);

			$discount = $this->discountItem->getDiscount();
			$price = $price - $price * $discount / 100;
			$price = floor($price * 100) / 100;
			$sum = $amount * $price;

//			echo __CLASS__.': '.implode(' ', array_keys($order)).' - '.$sum .PHP_EOL;

        }
        return $sum;
    }

	protected function isAllowed()
    {
        $order = $this->product->getOrder();
        if(!array_key_exists($this->discountItem->getProduct(), $order)){
            return false;
        }
        foreach($this->discountItem->getAdditionalProducts() as $type){
            if(array_key_exists($type, $order)){
                return true;
            }
        }unset($type);
        return false;
    }
}