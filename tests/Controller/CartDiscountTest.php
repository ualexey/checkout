<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartDiscountTest extends WebTestCase
{

    public function testSuccessExecute()
    {
        $cart = [
            [
                'productSku' => 'A',
                'count' => 1
            ],
            [
                'productSku' => 'B',
                'count' => 1
            ],
            [
                'productSku' => 'C',
                'count' => 1
            ],
            [
                'productSku' => 'D',
                'count' => 1
            ],
            [
                'productSku' => 'E',
                'count' => 1
            ],
        ];

        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/cart/total', [], [], [], json_encode($cart));

        $response = $client->getResponse()->getContent();

        $data = json_decode($response, true);

        foreach ($data as $val) {

            $this->assertArrayHasKey('productSku', $val);
            $this->assertArrayHasKey('count', $val);
            $this->assertArrayHasKey('price', $val);

            if ($val['productSku'] == 'A') {
                $this->assertEquals(1, $val['count']);
                $this->assertEquals(50, $val['price']);
            }

            if ($val['productSku'] == 'B') {
                $this->assertEquals(1, $val['count']);
                $this->assertEquals(30, $val['price']);
            }
            if ($val['productSku'] == 'C') {
                $this->assertEquals(1, $val['count']);
                $this->assertEquals(20, $val['price']);
            }
            if ($val['productSku'] == 'D') {
                $this->assertEquals(1, $val['count']);
                $this->assertEquals(5, $val['price']);
            }
            if ($val['productSku'] == 'E') {
                $this->assertEquals(1, $val['count']);
                $this->assertEquals(5, $val['price']);
            }
        }
    }


}
