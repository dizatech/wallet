<?php

namespace Modules\Wallet\Http\Requests;

use App\Facades\ValidationCommonHelperFacade;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'description'        => ['required'],
            'amount'             => ['required', 'gt:0'],
            'status_transaction' => ['required'],
            'user_id'            => ['required'],
            'wallet_id'          => ['required']
        ];
    }
    public function messages()
    {
        return [
            'description.required'        => 'لطفا توضیحات تراکنش را وارد کنید.'  ,
            'amount.required'             => 'لطفا مبلغ را وارد کنید.',
            'amount.gt'                   => ' مبلغ باید بزرگتر از صفر باشد.',
            'status_transaction.required' => 'لطفا نوع تراکنش را مشخص کنید.',
            'user_id.required'            => 'لطفا نام کاربر را انتخاب کنید.',
            'wallet_id.required'          => 'لطفا کیف پول را انتخاب کنید.'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'amount' => ValidationCommonHelperFacade::prepareInteger(request()->amount),
        ]);
    }
}
