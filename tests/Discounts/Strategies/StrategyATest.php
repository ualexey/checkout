<?php

namespace App\Tests\Discounts\Strategies;

use App\Discounts\DiscountManager;
use App\Discounts\Strategies\DiscountA;
use PHPUnit\Framework\TestCase;

class StrategyATest extends TestCase
{

    /** @test */
    public function discountAInstanceTest()
    {
        $xmlStrategy = new DiscountA();

        $this->assertInstanceOf(DiscountA::class, $xmlStrategy);
    }

    /** @test */
    public function noDiscountTest()
    {
        $cart = [
            [
                'productSku' => 'A',
                'count' => 1
            ],
        ];

        $manager = new DiscountManager(new DiscountA());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(50, $result);
    }

    /** @test */
    public function discountOnlyTest()
    {
        $cart = [
            [
                'productSku' => 'A',
                'count' => 3
            ],
        ];

        $manager = new DiscountManager(new DiscountA());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(130, $result);
    }

    /** @test */
    public function discountMultipleTest()
    {
        $cart = [
            [
                'productSku' => 'A',
                'count' => 4
            ],
        ];

        $manager = new DiscountManager(new DiscountA());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(180, $result);
    }


}
