<?php

namespace CMS\User\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class check_code_request extends FormRequest
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
                'mobile' => ['required'],
                'code' => ['required', 'min:5']
        ];
    }
}
