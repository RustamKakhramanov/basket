<?php

namespace App\Services\Cart;

use App\Entities\Abstracts\Cart;
use Illuminate\Support\Collection;

class CartService
{
    private $products;
    private $price;

    public function __construct ( Collection $products ) {
        $this->products = $products;
    }

    public function handle () {
        $this->calculateAllPrice();
        return $this;
    }

    public function getCartData () {
        return Cart::loadFields([
            'products' => $this->products,
            'price' => $this->price
        ]);
    }

    protected function calculateAllPrice () {
        $price = 0;

        $this->products->each(function ($product) use(&$price) {
            $price += $product->price;
        });

        $this->price = $price;
    }
}
