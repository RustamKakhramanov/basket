<?php

namespace App\Services\Cart;

use App\Services\ProductsCalculateFakeService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProductCalculateService
{
    private $data;

    /**
     * @param Collection $data
     */
    public function __construct ( Collection $data ) {
        $this->data = $data;
        $this->excludeFromCache();
    }

    /**
     * @return void
     */
    public function excludeFromCache () {
        if ( $cache = Cache::get( 'products.all' ) ) {
            $this->data = $this->data->whereNotIn( 'id', $cache->pluck( 'id' ) );
        }
    }

    /**
     * @return mixed
     */
    public function handle () {
//        $response = ( new ProductCalculateClient() )
//            ->sendDataForCalculate(
//                $this->data->toArray()
//            )->getBody(); //Original service Data

        $response_data = ProductsCalculateFakeService::calculate( $this->data->toArray() ); // Fake Service Data

        $products = CartProductParser::parseCollection( $response_data );

        return Cache::remember( 'products.all', 60 * 600, function () use ( $products ) {
            return $products;
        } );
    }
}
