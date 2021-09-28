<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Wallet\Facades\UserWalletFacade;
use Modules\Wallet\Http\Requests\WithdrawRequest;
use Modules\Wallet\Models\UserWallet;
use Modules\Wallet\Models\Withdraw;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::join('user_wallets', 'withdraws.user_wallet_id', 'user_wallets.id')
            ->select('withdraws.*')
            ->where('user_wallets.user_id', Auth::id())
            ->paginate();

        return view('vendor.wallet.home.withdraw.index', compact('withdraws'));
    }

    public function create(UserWallet $user_wallet)
    {
        return view('vendor.wallet.home.withdraw.create', compact('user_wallet'));
    }

    public function store(WithdrawRequest $request, Withdraw $withdraw, $user_wallet)
    {
        $user_wallet = UserWallet::find( $user_wallet );
        if( UserWalletFacade::withdraw($user_wallet, $request->amount, 'درخواست برداشت وجه') ){
            $withdraw->fill($request->all());
            $withdraw->user_wallet_id = $user_wallet->id;
            $withdraw->save();
            return redirect()->route('account.wallet.withdraw.index')->with(
                'success', 'درخواست شما با موفقیت ثبت شد'
            );
        }
        else{
            return redirect()->back()
                ->withErrors(['amount' => 'مبلغ درخواستی از موجودی بیشتر است.'])->withInput();
        }
    }
}
