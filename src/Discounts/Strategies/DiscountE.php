<?php

namespace App\Discounts\Strategies;

use App\Discounts\Interfaces\DiscountStrategyInterface;

class DiscountE implements DiscountStrategyInterface
{

    private $productSku = 'E';
    private $regularPrice = 5;
    private $regularAmount = 0;

    /**
     * @param array $cart
     * @return float
     */
    public function applyDiscount(array $cart): float
    {

        foreach ($cart as $item) {

            if ($item['productSku'] != $this->productSku) {
                continue;
            }

            $this->regularAmount += $this->regularPrice * $item['count'];

        }

        return round($this->regularAmount, 2);

    }
}
