<?php

namespace CMS\Order\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CMS\Order\Models\Order;
use Illuminate\Validation\Rule;
use CMS\Order\Rules\order_check_product;
use CMS\Order\Rules\order_check_user;

class AddOrderRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "user_id"=>["nullable",new order_check_user()],
            "products_id"=>new order_check_product(),
            "status"=>Rule::in(Order::$statuses),
            "price"=>"integer",
        ];
    }
}
