<?php

namespace CMS\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            "text"=>"required",
            "user_id"=>"required|integer",
            "post_id"=>"required|integer",
            "parent_id"=>"required|integer",
            "post_type"=>"required",
        ];
    }
}
