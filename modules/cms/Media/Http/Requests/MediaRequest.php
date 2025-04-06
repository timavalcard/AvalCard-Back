<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 1:18 AM
 */

namespace CMS\Media\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'media_field'=>'required',
            'media_field.*' => 'max:2048',
        ];
    }

    public function attributes()
    {
        return [
            "media_field"=>"رسانه"
        ];
    }
}
