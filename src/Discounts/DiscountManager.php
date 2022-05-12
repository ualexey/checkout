<?php

namespace App\Discounts;

use App\Discounts\Interfaces\DiscountStrategyInterface;


/**
 * Realiastion of Strategy Pattern
 */
class DiscountManager
{

    private $strategy;

    /**
     * @param DiscountStrategyInterface $strategy
     */
    public function __construct(DiscountStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param array $cart
     * @return float
     */
    public function getFinalPrice(array $cart): float
    {
        return $this->strategy->applyDiscount($cart);
    }

}
