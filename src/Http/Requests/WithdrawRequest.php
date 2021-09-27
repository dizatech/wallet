<?php

namespace Modules\Wallet\Http\Requests;

use App\Facades\SettingFacade;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Wallet\Models\UserWallet;

class WithdrawRequest extends FormRequest
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
        $user_wallet = UserWallet::findOrFail($this->route('user_wallet'));
        $amount_min = max(0, SettingFacade::get('wallet_min_withdraw_amount', 0));
        return [
            'amount'    => "required|integer|min:{$amount_min}|max:{$user_wallet->balance}",
            'bank_name' => "required",
            'iban'      => "required|iban"
        ];
    }

    public function messages()
    {
        return [
            'amount.min'    => 'مبلغ درخواستی نباید کمتر از حداقل برداشت باشد.',
            'amount.max'    => 'مبلغ درخواستی نباید از موجودی بیشتر باشد.'
        ];
    }

    protected function prepareForValidation()
    {
        if( isset( $this->amount ) ){
            $this->merge(['amount' => str_replace(",", "", $this->amount) * 10]); //Toman to Rial
        }
        if( isset( $this->iban ) ){
            $this->merge(['iban' => "IR" . $this->iban]);
        }
    }
}
