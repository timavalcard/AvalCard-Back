<?php

namespace CMS\User\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class forgot_password_send_request extends FormRequest
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
        $email_or_mobile=isEmail(request()->mobile)?"email":"mobile";
        return [
            'mobile' => ['required','exists:users,'.$email_or_mobile],
        ];
    }
}
