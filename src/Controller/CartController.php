<?php

namespace App\Controller;

use App\Discounts\DiscountManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    /**
     * @Route("/cart/total", name="getTotalPrice", methods={"POST"}))
     */
    public function getTotalPrice(Request $request): Response
    {

        $rawRequest = $request->getContent();

        $cart = json_decode($rawRequest, 1);

        foreach ($cart as $key => $item) {

            $discountStrategy = 'App\Discounts\Strategies\Discount' . $item['productSku'];

            if (class_exists($discountStrategy)) {
                $manager = (new DiscountManager(new $discountStrategy()));
                $cart[$key]['price'] = $manager->getFinalPrice($cart);
            } else {
                $cart[$key]['error'] = 'Strategy class undefined';
            }
        }

        $response = new Response();
        $response->setCharset('UTF-8');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($cart));
        return $response;
    }
}
