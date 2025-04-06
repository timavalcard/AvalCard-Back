<?php


namespace CMS\Marketing\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use CMS\Marketing\Services\AffiliateService;

class AffiliateAddSettlementRequest extends FormRequest
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

        $setting=AffiliateService::get_setting();
        return [
            'amount'=>'required|numeric|min:'.$setting["affiliate_min_inventory"]."|max:".auth()->user()->amount,

        ];
    }

    public function attributes()
    {
        return [
            'amount'=>'مبلغ',

        ];
    }
}
