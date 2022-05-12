<?php

namespace App\Discounts\Interfaces;

interface  DiscountStrategyInterface
{
    /***
     * @param array $cart
     * @return float
     */
    public function applyDiscount(array $cart): float;

}
