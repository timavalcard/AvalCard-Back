<?php


namespace CMS\Marketing\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AffiliateAddLinkRequest extends FormRequest
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
            "link"=>"required|url"
        ];
    }

    public function attributes()
    {
        return [
            "link"=>"لینک",

        ];
    }
}
