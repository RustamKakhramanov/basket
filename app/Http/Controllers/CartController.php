<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateShoppingCartRequest;
use App\Http\Resources\CartResource;
use App\Services\Cart\CartProductParser;
use App\Services\Cart\CartService;
use App\Services\Cart\ProductCalculateService;

class CartController extends Controller
{
    /**
     * @param CalculateShoppingCartRequest $request
     *
     * @return CartResource
     */
   public function calculate (CalculateShoppingCartRequest $request) {
       $products = CartProductParser::parseCollection($request->only('cart.products')['cart']['products']);
       $product_data = (new ProductCalculateService($products))->handle();
       $cart = (new CartService($product_data))->handle()->getCartData();

       return CartResource::make($cart);
   }
}
