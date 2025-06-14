<?php

namespace CMS\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use CMS\User\Models\User;

class AddUserRequest extends FormRequest
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
            "name" => "required",
            "email" => "required|unique:users,email",
            "mobile" => "required|unique:users,mobile",
            "password" => "required|confirmed",
            "role" => "required|array|min:1",
            "status" => Rule::in(User::ACCOUNT_STATUSES)
        ];
    }
}
