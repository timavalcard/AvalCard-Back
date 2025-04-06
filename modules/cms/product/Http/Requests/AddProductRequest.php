<?php

namespace CMS\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
        $rules= [
            "title"=>"required|unique:products,id,".request()->product_nick_name,
            "contents"=>"nullable",
            "excerpt"=>"nullable",
            "product_cat"=>"nullable",
            'thumbnail' => 'nullable',
            "slug"=>"nullable",
        ];
        if(request()->type == "simple"){
            $rules["price"]="nullable|min:0|numeric";
            $rules["offer_price"]="nullable|lt:price";
        }

        return $rules;
    }
}
