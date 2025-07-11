<?php

namespace CMS\Order\Rules;

use Illuminate\Contracts\Validation\Rule;
use CMS\User\Repositories\UserRepository;

class order_check_user implements Rule
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
        if($value==0) return true;

        if(!empty(UserRepository::find($value))) {
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
        return 'کاربر مورد نظر پیدا نشد';
    }
}
