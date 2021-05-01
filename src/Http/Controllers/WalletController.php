<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Wallet\Http\Requests\WalletRequest;
use Modules\Wallet\Models\Wallet;

class WalletController extends Controller
{
    public function index()
    {
        return view('vendor.wallet.panel.wallet.index', [
            'wallets' =>    Wallet::query()->paginate()
        ]);
    }

    public function create()
    {
        return view('vendor.wallet.panel.wallet.create');
    }

    public function store(WalletRequest $request, Wallet $wallet)
    {
        $wallet->fill($request->all());
        $wallet->save();
        session()->flash('success', 'ثبت کیف پول با موفقیت انجام شد.');
        return redirect()->route('wallet.edit', $wallet);
    }

    public function show(Wallet $wallet)
    {
    }

    public function edit(Wallet $wallet)
    {
        return view('vendor.wallet.panel.wallet.edit',[
            'wallet' => $wallet
        ]);
    }

    public function update(WalletRequest $request, Wallet $wallet)
    {
        $wallet->fill($request->all());
        $wallet->save();
        session()->flash('success', 'ویرایش کیف پول با موفقیت انجام شد.');
        return redirect()->back();
    }

    public function destroy(Wallet $wallet)
    {
        //
    }

    public function user_show()
    {

    }
}
