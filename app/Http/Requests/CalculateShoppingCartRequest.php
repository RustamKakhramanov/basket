<?php

namespace App\Http\Requests;

use App\Enums\PayTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalculateShoppingCartRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'cart' => 'required|array',
           'cart.products' => 'required|array',
           'cart.products.*.id' => 'integer|required',
           'cart.products.*.count' => 'integer|required',
           'cart.pay_type' => [
               'required',
               Rule::in(PayTypeEnum::getValues()),
           ],
           'address_id' => 'exists:addresses,id'
        ];
    }
}
