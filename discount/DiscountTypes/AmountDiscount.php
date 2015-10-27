<?php
namespace DiscountTypes;

use DiscountItems\AmountItem;

class AmountDiscount extends AbstractDiscountType{

    protected $discountItem;

    public function __construct(AmountItem $discountItem){
        $this->discountItem = $discountItem;
    }
    public function getHash(){
        $excludedProducts = $this->discountItem->getExcludedProducts();
        sort($excludedProducts);
        return $this->discountItem->getAmount().implode('',$excludedProducts);
    }
    public function countSum()
	{
		$sum = 0;
		if($this->isAllowed()){
			$discount = $this->discountItem->getDiscount();
			$order = $this->product->getOrder();
			$excludedProducts = $this->discountItem->getExcludedProducts();
			foreach($excludedProducts as $p){
				unset($order[$p]);
			}unset($p);

			$price = 0;
			foreach($order as $type => $amount){
				$price += $this->product->getPrice($type) * $amount;
			}unset($type, $amount);

			$price = $price - $price * $discount / 100;
			$price = floor($price * 100) / 100;
			$sum = $price;

//			echo __CLASS__.': '.implode(' ', array_keys($order)).' - '.$sum .PHP_EOL;

		}
		return $sum;
	}

    protected function isAllowed()
    {
		$order = $this->product->getOrder();
		$excludedProducts = $this->discountItem->getExcludedProducts();
		foreach($excludedProducts as $p){
			unset($order[$p]);
		}unset($p);

		if($this->discountItem->isAllowGreater()){
			return
				count($order) >= $this->discountItem->getAmount();
		}else{
			return
				count($order) == $this->discountItem->getAmount();
		}

    }
}