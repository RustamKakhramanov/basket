<?php

namespace App\Services\Cart;

use App\Entities\Abstracts\CartProduct;

class CartProductParser extends AbstractDataParser
{
    const ENTITY_CLASS = CartProduct::class;
}
