<?php

namespace CMS\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use CMS\Product\Rules\HourAndMinuteValidation;

class AddCouponRequest extends FormRequest
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
        $rules= [
            "name"=>"required|min:2|unique:coupon",
            "price_offering"=>"numeric|min:0",
            "price_type"=>[Rule::in(["percent","cash"])],
            "time"=>"date",
            "hour"=>["required",new HourAndMinuteValidation()],
            'number' => 'nullable|numeric|min:0',
        ];

        return $rules;
    }
}
