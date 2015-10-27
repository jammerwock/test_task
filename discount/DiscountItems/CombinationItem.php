<?php
namespace DiscountItems;

class CombinationItem extends AbstractDiscountItem
{

    protected $products = array();
    protected $discount = 0;

    /**
     * CombinationItem constructor.
     * @param array $products
     * @param int $discount
     */
    public function __construct(array $products, $discount)
    {
        $this->products = $products;
        $this->discount = $discount;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }


}