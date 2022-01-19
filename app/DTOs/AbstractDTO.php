<?php

namespace App\DTOs;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

abstract class AbstractDTO implements JsonSerializable
{

    public function __construct($payload){
        if(is_array($payload)) {
            foreach ($payload as $key => $value ) {
                if(isset($this->$key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function __get($name)
    {
        return isset($this->$name)
            ? $this->$name
            : null;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
