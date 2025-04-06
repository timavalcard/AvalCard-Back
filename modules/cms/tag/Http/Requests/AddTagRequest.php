<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/28/2020
 * Time: 9:21 PM
 */

namespace CMS\Tag\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AddTagRequest extends FormRequest
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
            "name"=>"required|unique:tags,name",
            "slug"=>"max:100|unique:tags,slug",
            "contents"=>"nullable"
        ];
    }

    public function attributes()
    {
        return [
            "slug"=>"نام انگلیسی",
            "name"=>"نام ",
        ];
    }
}
