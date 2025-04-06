<?php

namespace CMS\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use CMS\User\Models\User;

class EditAccountRequest extends FormRequest
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
        $rules=[
            "email" => "nullable|email",
            'mobile' => 'nullable|regex:/(09)[0-9]{9}/|digits:11|numeric',
        ];

        if (!empty(request()->password)){
            $rules["password"]='password';
            $rules["new_password"]='confirmed';
        }



        return  $rules;
    }
}
