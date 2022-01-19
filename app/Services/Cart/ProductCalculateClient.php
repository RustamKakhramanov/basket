<?php

namespace App\Services\Cart;

use App\Services\ProductsCalculateFakeService;
use GuzzleHttp\Client;

class ProductCalculateClient extends Client
{

    public function __construct ( array $config = [] ) {
        if ( !isset( $config[ 'base_uri' ] ) ) {
            $config[ 'base_uri' ] = config( 'products.client' );
        }

        parent::__construct( $config );
    }

    public function sendDataForCalculate ( $data ) {
        return $this->post( 'calculate', $data );
    }
}
