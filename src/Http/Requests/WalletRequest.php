<?php

namespace Wallet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WalletRequest extends FormRequest
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

    public function rules()
    {
        return [
            'title'     => ['required'],
            'name'      => ['required', 'unique:wallets'],
            'is_active' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required'      => 'لطفا عنوان کیف پول را وارد کنید.',
            'is_active.required'  => 'لطفا وضعیت کیف پول را مشخص کنید.',
            'name.required'       => 'لطفا نام کیف پول را وارد کنید.',
            'name.unique'         => 'مقدار نام تکراری است.',
            'name.username'       => 'فیلد نام شامل حرف، اعداد و ـ می تواند باشد.',
        ];
    }
}
