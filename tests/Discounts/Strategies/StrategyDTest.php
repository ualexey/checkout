<?php

namespace App\Tests\Discounts\Strategies;

use App\Discounts\DiscountManager;
use App\Discounts\Strategies\DiscountD;
use PHPUnit\Framework\TestCase;

class StrategyDTest extends TestCase
{

    /** @test */
    public function discountAInstanceTest()
    {
        $xmlStrategy = new DiscountD();

        $this->assertInstanceOf(DiscountD::class, $xmlStrategy);
    }

    /** @test */
    public function noDiscountTest()
    {
        $cart = [
            [
                'productSku' => 'D',
                'count' => 1
            ],
        ];

        $manager = new DiscountManager(new DiscountD());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(15, $result);
    }

    /** @test */
    public function discountOneATest()
    {
        $cart = [
            [
                'productSku' => 'A',
                'count' => 1
            ],
            [
                'productSku' => 'D',
                'count' => 1
            ],
        ];

        $manager = new DiscountManager(new DiscountD());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(5, $result);
    }

    /** @test */
    public function discountManyATest()
    {
        $cart = [
            [
                'productSku' => 'A',
                'count' => 2
            ],
            [
                'productSku' => 'D',
                'count' => 1
            ],
        ];

        $manager = new DiscountManager(new DiscountD());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(5, $result);
    }

    /** @test */
    public function discountMultipleTest()
    {
        $cart = [
            [
                'productSku' => 'A',
                'count' => 7
            ],
            [
                'productSku' => 'D',
                'count' => 5
            ],
        ];

        $manager = new DiscountManager(new DiscountD());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(25, $result);
    }

}
