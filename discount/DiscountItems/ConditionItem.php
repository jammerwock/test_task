<?php
namespace DiscountItems;

class ConditionItem extends AbstractDiscountItem{

    protected $product;
    protected $additionalProducts;
    protected $discount;

    /**
     * ConditionItem constructor.
     * @param string $product
     * @param array $additionalProducts
     * @param int $discount
     */
    public function __construct($product, $additionalProducts, $discount)
    {
        $this->product = $product;
        $this->additionalProducts = $additionalProducts;
        $this->discount = $discount;
    }

    /**
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return array
     */
    public function getAdditionalProducts()
    {
        return $this->additionalProducts;
    }

    /**
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }

}