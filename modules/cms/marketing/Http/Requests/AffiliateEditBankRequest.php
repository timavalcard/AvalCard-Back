<?php


namespace CMS\Marketing\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AffiliateEditBankRequest extends FormRequest
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
            'bank_owner_name'=>'required',
            'bank_shaba_number' => 'required|digits:26',
            'bank_cart_number' => 'required|numeric|digits:13',
            'bank_account_number' => 'required|numeric',
            'bank_name' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'bank_owner_name'=>'نام صاحب کارت',
            'bank_shaba_number' => 'شماره شبا',
            'bank_cart_number' => 'شماره کارت',
            'bank_account_number' => 'شماره حساب',
            'bank_name' => 'نام بانک',
        ];
    }
}
