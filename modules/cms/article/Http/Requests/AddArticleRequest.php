<?php

namespace CMS\Article\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddArticleRequest extends FormRequest
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
            "title"=>"required|unique:articles",
            "contents"=>"required",
            "excerpt"=>"nullable",
            "article_cat"=>"nullable",
            "article_tag"=>"nullable",
            "user_id"=>"required",
            'thumbnail' => 'required',
            "slug"=>"nullable"
        ];
    }
}
