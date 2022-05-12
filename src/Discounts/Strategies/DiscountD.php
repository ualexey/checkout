<?php

namespace App\Discounts\Strategies;

use App\Discounts\Interfaces\DiscountStrategyInterface;

class DiscountD implements DiscountStrategyInterface
{

    private $productSku = 'D';
    private $regularPrice = 15;
    private $discountPrice = 5;
    private $discountWithItem = 'A';
    private $discountItemCount = 0;
    private $targetItemsCount = 0;
    private $regularAmount = 0;
    private $discountAmount = 0;

    /**
     * @param array $cart
     * @return float
     */
    public function applyDiscount(array $cart): float
    {

        foreach ($cart as $item) {
            if ($item['productSku'] == $this->productSku) {
                $this->targetItemsCount = $item['count'];;
            }
            if ($item['productSku'] == $this->discountWithItem) {
                $this->discountItemCount = $item['count'];;
            }
        }

        $this->discountItemCount = ($this->discountItemCount > $this->targetItemsCount) ? $this->targetItemsCount : $this->discountItemCount;

        if ($this->discountItemCount > 0) {

            $this->discountAmount = $this->discountPrice * $this->discountItemCount;
            $this->regularAmount = $this->regularPrice * ($this->targetItemsCount - $this->discountItemCount);

        } else {

            $this->regularAmount = $this->regularPrice * ($this->targetItemsCount - $this->discountItemCount);
        }

        return round($this->regularAmount + $this->discountAmount, 2);
    }

}
