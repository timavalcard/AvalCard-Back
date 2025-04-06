<?php


namespace CMS\Brand\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            "name"=>"required|unique:brands,name",
            "slug"=>"max:100|unique:brands,slug",
            "parent"=>"required",
            "contents"=>"nullable",
            "offer"=>"nullable|integer|min:0|max:100"
        ];
        if(request()->method() == "PUT"){
            $data["name"]="required|unique:brands,name,".request()->id;
            $data["slug"]="max:100|unique:brands,slug,".request()->id;
        }
        return $data;
    }

    public function attributes()
    {
        return [
            "slug"=>"نام انگلیسی",
            "name"=>"نام ",
        ];
    }
}
