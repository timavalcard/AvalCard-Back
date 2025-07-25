<?php

namespace CMS\Order\Rules;

use Illuminate\Contracts\Validation\Rule;
use CMS\Product\Repository\ProductRepository;

class order_check_product implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
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
        if(!empty(ProductRepository::find($value))) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'محصول مورد نظر پیدا نشد';
    }
}
