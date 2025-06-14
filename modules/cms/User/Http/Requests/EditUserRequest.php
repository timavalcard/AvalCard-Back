<?php

namespace CMS\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use CMS\User\Models\User;

class EditUserRequest extends FormRequest
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
            "name" => "nullable",
            "email" => "nullable|unique:users,email,".request()->id,
            "mobile" => "nullable|unique:users,mobile,".request()->id,

            'password' => 'confirmed',
            //"role" => "required|array|min:1",
            "status" => Rule::in(User::ACCOUNT_STATUSES)
        ];
    }
}
