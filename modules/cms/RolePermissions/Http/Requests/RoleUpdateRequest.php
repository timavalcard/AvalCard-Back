<?php

namespace CMS\RolePermissions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            "id" => "required|exists:roles,id",
            "name" => "required|min:3|unique:roles,name," . request()->id,
            "permissions" => "required|array|min:1"
        ];
    }
}
