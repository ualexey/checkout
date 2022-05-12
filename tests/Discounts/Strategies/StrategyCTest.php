<?php

namespace App\Tests\Discounts\Strategies;

use App\Discounts\DiscountManager;
use App\Discounts\Strategies\DiscountC;
use PHPUnit\Framework\TestCase;

class StrategyCTest extends TestCase
{

    /** @test */
    public function discountAInstanceTest()
    {
        $xmlStrategy = new DiscountC();

        $this->assertInstanceOf(DiscountC::class, $xmlStrategy);
    }

    /** @test */
    public function noDiscountTest()
    {
        $cart = [
            [
                'productSku' => 'C',
                'count' => 1
            ],
        ];

        $manager = new DiscountManager(new DiscountC());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(20, $result);
    }

    /** @test */
    public function discountOnlyTest1()
    {
        $cart = [
            [
                'productSku' => 'C',
                'count' => 2
            ],
        ];

        $manager = new DiscountManager(new DiscountC());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(38, $result);
    }

    /** @test */
    public function discountOnlyTest2()
    {
        $cart = [
            [
                'productSku' => 'C',
                'count' => 3
            ],
        ];

        $manager = new DiscountManager(new DiscountC());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(50, $result);
    }

    /** @test */
    public function discountMultipleTest1()
    {
        $cart = [
            [
                'productSku' => 'C',
                'count' => 4
            ],
        ];

        $manager = new DiscountManager(new DiscountC());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(70, $result);
    }

    /** @test */
    public function discountMultipleTest2()
    {
        $cart = [
            [
                'productSku' => 'C',
                'count' => 5
            ],
        ];

        $manager = new DiscountManager(new DiscountC());
        $result = $manager->getFinalPrice($cart);

        $this->assertEquals(88, $result);
    }
}
