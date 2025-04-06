<?php

namespace CMS\Settlement\Http\Requests;

use Hamcrest\Core\Set;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use CMS\City\Repositories\CityRepo;
use CMS\Settlement\Models\Settlement;
use CMS\RolePermission\Repositories\RoleRepo;
use Spatie\Permission\Models\Role;

class settlement_edit_request extends FormRequest
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

            'cart_number' => ['required','numeric'],

//            'amount' => ['required','numeric','min:0','max:'.(auth()->user()->amount+$this->amount)],
            'status' => ['required','string','in:'.Settlement::STATUS_CANCELED.','.Settlement::STATUS_REJECTED.','.Settlement::STATUS_SETTLED.','.Settlement::STATUS_PENDING],
        ];
    }
}
