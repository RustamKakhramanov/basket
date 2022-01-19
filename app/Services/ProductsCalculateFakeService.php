<?php

namespace App\Services;

class ProductsCalculateFakeService
{
    public static function calculate ( $products ) {
        return collect( $products )->map( function ( $item ) {
            $item[ 'price' ] = rand( 200, 400 );
            return $item;
        } );
    }
}
