<?php

namespace App\Discounts\Strategies;

use App\Discounts\Interfaces\DiscountStrategyInterface;

class DiscountC implements DiscountStrategyInterface
{

    private $productSku = 'C';
    private $regularPrice = 20;
    private $discountPriceLow = 38;
    private $discountFromItemsLow = 2;
    private $discountPriceHigh = 50;
    private $discountFromItemsHigh = 3;
    private $regularAmount = 0;
    private $discountAmount = 0;
    private $otherItems = 0;

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

            $this->otherItems = $item['count'];

            if ($this->otherItems >= $this->discountFromItemsHigh) {
                $this->highDiscount();
            }

            if ($this->otherItems >= $this->discountFromItemsLow) {
                $this->lowDiscount();
            }

            if ($this->otherItems > 0) {
                $this->noDiscount();
            }
        }

        return round($this->regularAmount + $this->discountAmount, 2);
    }

    private function highDiscount(): void
    {
        $this->discountAmount += $this->discountPriceHigh * intval($this->otherItems / $this->discountFromItemsHigh);
        $this->otherItems = $this->otherItems % $this->discountFromItemsHigh;
    }

    private function lowDiscount(): void
    {
        $this->discountAmount += $this->discountPriceLow * intval($this->otherItems / $this->discountFromItemsLow);
        $this->otherItems = $this->otherItems % $this->discountFromItemsLow;
    }

    private function noDiscount(): void
    {
        $this->regularAmount += $this->regularPrice * $this->otherItems;
    }

}
