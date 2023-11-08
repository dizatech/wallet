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
        $rules = [
            'description'        => ['required'],
            'amount'             => ['required', 'gt:0'],
            'status_transaction' => ['required'],
            'user_id'            => ['required'],
            'wallet_id'          => ['required']
        ];

        if (request()->has('status_transaction') && request()->status_transaction=='payment_inquiry') {
            $rules['receipt_date']  = ['required', 'date_format:Y-m-d'];
            $rules['pay_info'] = ['required'];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'description.required'        => 'لطفا توضیحات تراکنش را وارد کنید.'  ,
            'amount.required'             => 'لطفا مبلغ را وارد کنید.',
            'amount.gt'                   => ' مبلغ باید بزرگتر از صفر باشد.',
            'status_transaction.required' => 'لطفا نوع تراکنش را مشخص کنید.',
            'user_id.required'            => 'لطفا نام کاربر را انتخاب کنید.',
            'wallet_id.required'          => 'لطفا کیف پول را انتخاب کنید.',
            'pay_info.required'             => 'لطفا پس از استعلام پرداخت، گزینه مورد نظر خود را انتخاب کنید.'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'amount' => ValidationCommonHelperFacade::prepareInteger(request()->amount),
        ]);
    }
}
