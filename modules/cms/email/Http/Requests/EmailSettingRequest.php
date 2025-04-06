<?php

namespace CMS\Email\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use CMS\User\Models\User;

class EmailSettingRequest extends FormRequest
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
        return  [
            "server_name"=>"required",
            "server_port"=>"required",
            "email_username"=>"required",
            "email_password"=>"required",
            "sender_email"=>"required|email",
            "sender_name"=>"required",
            "email_encryption"=>"required",
        ];
    }
}
