<?php

namespace CMS\User\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class forgot_password_check_code_request extends FormRequest
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
        //* password Should have at least 1 letter 1 number and 6 length
        return [
            'mobile' => ['required', 'regex:/^(09)[0-9]{9}/', 'digits:11', 'numeric'],
            'code' => ['required', 'string', 'min:' . config('verify.code.length')],
            'password' => ['required', 'confirmed', 'string', 'min:6', 'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'],
        ];
    }
}
