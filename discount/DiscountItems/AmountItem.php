<?php
namespace DiscountItems;

class AmountItem extends AbstractDiscountItem{

    protected $amount;
    protected $allowGreater;
    protected $excludedProducts;
    protected $discount;

    /**
     * AmountItem constructor.
     * @param int $amount
     * @param bool $allowGreater
     * @param array $excludedProducts
     * @param int $discount
     */
    public function __construct($amount, $allowGreater, $excludedProducts, $discount)
    {
        $this->amount = $amount;
        $this->allowGreater = $allowGreater;
        $this->excludedProducts = $excludedProducts;
        $this->discount = $discount;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return bool
     */
    public function isAllowGreater()
    {
        return $this->allowGreater;
    }

    /**
     * @return array
     */
    public function getExcludedProducts()
    {
        return $this->excludedProducts;
    }

	/**
	 * @return int
	 */
	public function getDiscount()
	{
		return $this->discount;
	}


}