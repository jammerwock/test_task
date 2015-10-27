<?php

include "autoload.php";

use Product as P;
use DiscountTypes\AmountDiscount;
use DiscountTypes\ConditionDiscount;
use DiscountTypes\CombinationDiscount;

use DiscountItems\AmountItem;
use DiscountItems\ConditionItem;
use DiscountItems\CombinationItem;



// note  priority of discount defined by order
$productPrices = new Product('ABAABDEGKMCH');

$pcAB  = new CombinationItem(array(P::A, P::B), P::DISCOUNT_10);
$pcDE  = new CombinationItem(array(P::D, P::E), P::DISCOUNT_5);
$pcEFG = new CombinationItem(array(P::E, P::F, P::G), P::DISCOUNT_5);
$productPrices->addDiscount(new CombinationDiscount($pcAB));
$productPrices->addDiscount(new CombinationDiscount($pcDE));
$productPrices->addDiscount(new CombinationDiscount($pcEFG));

$oneAndOne = new ConditionItem(Product::A, array(P::K, P::L, P::M), P::DISCOUNT_5);
$productPrices->addDiscount(new ConditionDiscount($oneAndOne));

$amountThree        = new AmountItem(3, false, array(P::A, P::C), P::DISCOUNT_5);
$amountFour         = new AmountItem(4, false, array(P::A, P::C), P::DISCOUNT_10);
$amountFiveOrMore   = new AmountItem(5, true,  array(P::A, P::C), P::DISCOUNT_20);
$productPrices->addDiscount(new AmountDiscount($amountThree));
$productPrices->addDiscount(new AmountDiscount($amountFour));
$productPrices->addDiscount(new AmountDiscount($amountFiveOrMore));

//print_r($productPrices->getOrder());
echo $productPrices->getSum();
