<?php

namespace App\Entities\Abstracts;

use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractEntity implements Arrayable
{

    public function toArray () {
        return get_object_vars($this);
    }

    public static function loadFields($data)
    {
        $entity = new static();

        foreach ($data as $key => $value) {
            if (property_exists($entity, $key)) {
                $entity->{$key} = $value;
            }
        }

        return $entity;
    }
}
