<?php

namespace App\Discounts\Strategies;

use App\Discounts\Interfaces\DiscountStrategyInterface;

class DiscountA implements DiscountStrategyInterface
{

    private $productSku = 'A';
    private $regularPrice = 50;
    private $discountPrice = 130;
    private $discountFromItems = 3;
    private $regularAmount = 0;
    private $discountAmount = 0;

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

            if ($item['count'] >= $this->discountFromItems) {
                $this->regularAmount += $this->regularPrice * ($item['count'] % $this->discountFromItems);

                $this->discountAmount += $this->discountPrice * intval($item['count'] / $this->discountFromItems);
            } else {
                $this->regularAmount += $this->regularPrice * $item['count'];
            }

        }

        return round($this->regularAmount + $this->discountAmount, 2);
    }


}
