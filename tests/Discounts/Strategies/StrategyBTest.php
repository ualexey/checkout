<?php

namespace App\Tests\Discounts\Strategies;

use App\Discounts\DiscountManager;
use App\Discounts\Strategies\DiscountB;
use PHPUnit\Framework\TestCase;

class StrategyBTest extends TestCase
{

    /** @test */
    public function discountAInstanceTest()
    {
        $xmlStrategy = new DiscountB();

        $this->assertInstanceOf(DiscountB::class, $xmlStrategy);
    }

    /** @test */
    public function noDiscountTest()
    {
        $cart = [
            [
                'productSku' => 'B',
                'count' => 1
            ],
        ];

        $manager = new DiscountManager(new DiscountB());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(30, $result);
    }

    /** @test */
    public function discountOnlyTest()
    {
        $cart = [
            [
                'productSku' => 'B',
                'count' => 2
            ],
        ];

        $manager = new DiscountManager(new DiscountB());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(45, $result);
    }

    /** @test */
    public function discountMultipleTest()
    {
        $cart = [
            [
                'productSku' => 'B',
                'count' => 3
            ],
        ];

        $manager = new DiscountManager(new DiscountB());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(75, $result);
    }


}
