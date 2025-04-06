<?php


namespace CMS\Category\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $data=[
            "name"=>"required|unique:category,name",
            "slug"=>"max:100|unique:category,slug",
            "parent"=>"required",
            "contents"=>"nullable",
            "offer"=>"nullable|integer|min:0|max:100"
        ];
        if(request()->method() == "PUT"){
            $data["name"]="required|unique:category,name,".request()->id;
            $data["slug"]="max:100|unique:category,slug,".request()->id;
        }
        return $data;
    }

    public function attributes()
    {
        return [
            "slug"=>"نام انگلیسی",
            "name"=>"نام ",
            "offer"=>"تخفیف ",
        ];
    }
}
