<?php

namespace CMS\User\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class register_request extends FormRequest
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
                'mobile' => ['required'],
                //'password' => ['required', 'confirmed', 'min:6'],
        ];
    }
}
