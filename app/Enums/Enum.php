<?php

namespace App\Enums;

use ReflectionClass;

abstract class Enum
{
    public static function getValues(): array {
        $oClass = new ReflectionClass(static::class);

        return $oClass->getConstants();
    }
}
