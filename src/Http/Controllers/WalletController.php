<?php

namespace Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wallet\Http\Requests\WalletRequest;
use Wallet\Models\Wallet;

class WalletController extends Controller
{
    public function index()
    {
        return view('wallet::wallet.index', [
            'wallets' =>    Wallet::query()->paginate()
        ]);
    }

    public function create()
    {
        return view('wallet::wallet.create');
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
        return view('wallet::wallet.edit',[
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
