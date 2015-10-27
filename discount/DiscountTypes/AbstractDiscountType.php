<?php
namespace DiscountTypes;

abstract class AbstractDiscountType
{
    /**
     * @var $product \Product
     */
    protected $product;

    public function setProduct(\Product $product)
    {
        $this->product = $product;
    }

    abstract public function getHash();
    abstract public function countSum();
    abstract protected function isAllowed();
}