<?php

namespace App\Http\Requests;

use App\Rules\ValidShopProductQuantity;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'shop_product_id' => 'required|exists:shop_products,id',
            'customer_name' =>  'required|string',
            'quantity' => ['required', 'integer', 'min:1', new ValidShopProductQuantity($this->get('shop_product_id'))],
        ];
    }
}
