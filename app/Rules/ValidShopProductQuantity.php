<?php

namespace App\Rules;

use App\Models\ShopProduct;
use Illuminate\Contracts\Validation\Rule;

class ValidShopProductQuantity implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(protected int $shop_product_id)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ShopProduct::query()
            ->findOrFail($this->shop_product_id)->quantity >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'not enough quantity in stock';
    }
}
