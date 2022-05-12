<?php

namespace App\Tests\Discounts\Strategies;

use App\Discounts\DiscountManager;
use App\Discounts\Strategies\DiscountE;
use PHPUnit\Framework\TestCase;

class StrategyETest extends TestCase
{

    /** @test */
    public function discountAInstanceTest()
    {
        $xmlStrategy = new DiscountE();

        $this->assertInstanceOf(DiscountE::class, $xmlStrategy);
    }

    /** @test */
    public function noDiscountTest()
    {
        $cart = [
            [
                'productSku' => 'E',
                'count' => 1
            ],
        ];

        $manager = new DiscountManager(new DiscountE());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(5, $result);
    }

    /** @test */
    public function noDiscountMultipleTest()
    {
        $cart = [
            [
                'productSku' => 'E',
                'count' => 3
            ],
        ];

        $manager = new DiscountManager(new DiscountE());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(15, $result);
    }

}
