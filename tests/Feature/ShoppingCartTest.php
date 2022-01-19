<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ShoppingCartTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function thisShouldCalculatePrice()
    {
        $response = $this->json('POST', 'api/cart/calculate', [
            'cart' => [
                'products' => [
                    [
                        'id' => 11,
                        'count' => 11
                    ],
                    [
                        'id' => 12,
                        'count' => 11
                    ],
                ],
                'pay_type' => 'card',

            ]
        ]);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data' => [
                'products',
                'price'
            ]
        ]);
        $data = $response['data'];

        $price = 0;
        $products = Cache::get('products.all');

        $products->each(function ($product) use(&$price) {
            $price += $product->price;
        });

        $this->assertEquals($data['price'], $price);
        $this->assertEquals($data['products'], $products->toArray());

    }
}
