<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/28/2020
 * Time: 10:22 PM
 */

namespace CMS\Page\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AddPageRequest extends FormRequest
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
            "title"=>"required|unique:pages",
            "contents"=>"nullable",
            "excerpt"=>"nullable",
            "slug"=>"nullable",
            "user_id"=>"required",

        ];
    }
}
