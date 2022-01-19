<?php

namespace App\Services\Cart;

use App\Entities\Abstracts\AbstractEntity;

abstract class AbstractDataParser
{
    /**
     * @var AbstractEntity $class
     */
    public static function parseCollection ( $data ) {
        return collect( $data )->map( function ( $item ) {
            $class = static::ENTITY_CLASS;

            return $class::loadFields( $item );
        } );
    }
}
