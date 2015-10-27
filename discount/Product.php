<?php

use DiscountTypes\AbstractDiscountType;

class Product{

    const DISCOUNT_5 = 5;
    const DISCOUNT_10 = 10;
    const DISCOUNT_20 = 20;

    const A = 'a';
    const B = 'b';
    const C = 'c';
    const D = 'd';
    const E = 'e';
    const F = 'f';
    const G = 'g';
    const H = 'h';
    const I = 'i';
    const J = 'j';
    const K = 'k';
    const L = 'l';
    const M = 'm';

    private $sum = 0;

    private $order = array();

    private $discounts = array();

    private $productPrices = array(
        self::A => 101,
        self::B => 102,
        self::C => 103,
        self::D => 104,
        self::E => 105,
        self::F => 106,
        self::G => 107,
        self::H => 108,
        self::I => 109,
        self::J => 110,
        self::K => 111,
        self::L => 112,
    );


    function __construct($rawData){
        $rawData = strtolower(trim($rawData));
        $rawProducts = str_split($rawData);
        $productTypes = array_keys($this->productPrices);
        $cleanProducts = array_intersect($rawProducts, $productTypes);
        $this->order = array_count_values($cleanProducts);
    }


    public function getOrder(){
        return $this->order;
    }

    public function decreaseOrderAmount($type, $amount){
        if(!isset($this->order[$type])){
            return false;
        }
        $this->order[$type] -= $amount;
        if($this->order[$type] <= 0){
            unset($this->order[$type]); // no zero values in order
        }
    }
    public function getOrderAmount($type){
        if(!isset($this->order[$type])){
            return 0;
        }
        return $this->order[$type];
    }

    public function getPrice($type){
        if(!array_key_exists($type, $this->productPrices)){
            return 0;
        }
        return $this->productPrices[$type];
    }

    public function addDiscount(AbstractDiscountType $discount){
        $discount->setProduct($this);
        $this->discounts[$discount->getHash()] = $discount;
    }

    public function getSum(){
        if(!$this->order){
            return 0;
        }
        /**
         * @var $discount AbstractDiscountType
         */
        foreach($this->discounts as $discount){
            $this->sum += $discount->countSum();
        }unset($discount);

        return $this->finalCount();
    }

    private function finalCount(){
        foreach($this->order as $type => $amount){
            $this->sum += $this->productPrices[$type] * $amount;
        }unset($type, $amount);
        return $this->sum;
    }

}