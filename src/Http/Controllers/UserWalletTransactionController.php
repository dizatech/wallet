<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Wallet\Http\Requests\TransactionRequest;
use Modules\Wallet\Models\UserWallet;
use Modules\Wallet\Models\UserWalletTransaction;
use Modules\Wallet\Models\Wallet;

class UserWalletTransactionController extends Controller
{

    public function index(Request $request)
    {
        $transactions = UserWalletTransaction::query()->orderBy('created_at', 'desc');

        $transactions = $this->filter($request, $transactions);

        return view('vendor.wallet.panel.transaction.index', [
            'transactions' => $transactions->paginate(),
            'users'        => User::query()->get(),
            'wallets'      => Wallet::query()->where('is_active', 1)->get()
        ]);
    }

    public function create(Request $request)
    {
        return view('vendor.wallet.panel.transaction.create', [
            'users' => User::query()->get(),
            'user_id' => $request->user_id ?? 0,
            'wallets' => Wallet::query()->where('is_active', 1)->get()
        ]);
    }

    public function store(TransactionRequest $request, UserWalletTransaction $transaction)
    {
        //wallet
        $user_wallet = UserWallet::where('user_id', $request->user_id)
            ->where('wallet_id', $request->wallet_id)
            ->first();
        if ($user_wallet == NULL && $request->status_transaction == 'dec') {
            return redirect()->back()->withErrors(['amount' => 'کیف پول انتخاب شده موجودی ندارد.'])->withInput();
        }
        elseif ($request->status_transaction == 'dec' && $request->amount > $user_wallet->balance) {
            return redirect()->back()->withErrors(['amount' => 'مبلغ قابل برداشت از موجودی حساب شما بیشتر است.'])->withInput();
        }

        $transaction->fill($request->all());
        $transaction->creator_id = auth()->user()->id;
        $transaction->wallet_id = $request->wallet_id;
        if ($request->status_transaction == 'increase') {
            $transaction->amount = $request->amount;
        } else {
            $transaction->amount = -1 * $request->amount;
        }
        $transaction->save();
        session()->flash('success', 'ثبت تراکنش با موفقیت انجام شد.');
        return redirect()->route('transaction.index');
    }

    public function show(UserWalletTransaction $userWalletTransaction)
    {
    }

    public function edit(UserWalletTransaction $userWalletTransaction)
    {
    }

    public function update(Request $request, UserWalletTransaction $userWalletTransaction)
    {
    }

    public function destroy(UserWalletTransaction $userWalletTransaction)
    {
    }

    public function walletsIndex(Wallet $wallet)
    {
        $uid = Auth::user()->id;
        $balance = UserWallet::where('user_id', $uid)
            ->whereHas('wallet', function (Builder $query) {
                $query->where('is_active', 1);
            })->with('wallet')
            ->sum('balance');

        $wallets = UserWallet::query()->where('user_id', $uid)
            ->whereHas('wallet', function ($query) {
                $query->where('is_active', 1);
            })
            ->get();

        return view('vendor.wallet.home.walletUser', compact(['balance', 'wallets']));
    }

    public function wallet($id)
    {
        $uid = Auth::user()->id;
        $wallet = UserWallet::query()->where('user_id', $uid)
            ->sum('balance');

        $transactions = UserWalletTransaction::query()->where('user_id', $uid)->get();

        return view('vendor.wallet.home.wallet', compact('wallet', 'transactions'));
    }

    public function filter(Request $request, Builder $transactions): Builder
    {
        if ($request->has('id') && isset($request->id))
            $transactions = $transactions->where('id', $request->id);

        if ($request->has('transaction_date_from') && isset($request->transaction_date_from)) {
            $date = $request->transaction_date_from . " 00:00:00";
            $transactions = $transactions->where('created_at', '>=', $date);
        }
        if ($request->has('transaction_date_until') && isset($request->transaction_date_until)) {
            $date = $request->transaction_date_until . " 23:59:59";
            $transactions = $transactions->where('created_at', '<=', $date);
        }

        if ($request->has('amount') && isset($request->amount))
            $transactions = $transactions->where('amount', $request->amount);

        if ($request->has('user_id') && isset($request->user_id))
            $transactions = $transactions->where('user_id', $request->user_id);

        if ($request->has('creator_id') && isset($request->creator_id))
            $transactions = $transactions->where('creator_id', $request->creator_id);

        if ($request->has('wallet_id') && isset($request->wallet_id))
            $transactions = $transactions->where('wallet_id', $request->wallet_id);

        if (request()->has('from_amount') && request('from_amount')){
            $amount = floatval( str_replace(',', '', request('from_amount')) );
            $transactions = $transactions->whereRaw("ABS(amount) >= {$amount}" );
        }

        if (request()->has('until_amount') && request('until_amount')){
            $amount = floatval( str_replace(',', '', request('until_amount')) );
            $transactions = $transactions->whereRaw("ABS(amount) <= {$amount}" );
        }

        if ($request->has('description') && isset($request->description))
            $transactions = $transactions->where('description', 'LIKE' , '%'.$request->description.'%');

        return $transactions;
    }
}
