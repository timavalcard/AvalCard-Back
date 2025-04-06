<?php

namespace CMS\Services\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditServicesRequest extends FormRequest
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
            "name"=>"required|unique:services,name,".request()->id,
            "slug"=>'unique:services,slug,'.request()->id,
        ];
    }
}
