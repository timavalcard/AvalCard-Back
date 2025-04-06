<?php

namespace CMS\Settlement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class settlement_store_request extends FormRequest
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

            'cart_number' => "required|string|min:26|max:26",
            'amount' => ['required'],
        ];
    }
    public function attributes()
    {
        return [
            "cart_number"=>"شماره شبا"
        ];
    }
}
