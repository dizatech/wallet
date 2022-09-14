<?php


namespace Modules\Wallet\Repositories;

use Illuminate\Support\Facades\Auth;
use Modules\Wallet\Models\UserWallet;
use Modules\Wallet\Models\UserWalletTransaction;
use Modules\Wallet\Models\Wallet;

class UserWalletRepository
{
    public function all()
    {
        return UserWalletTransaction::all();
    }

    public function allWithPaginate()
    {
        return UserWalletTransaction::query()->paginate();
    }

    public function getActive()
    {
        return Wallet::where('is_active', 1)->get();
    }

    public function findActiveWalletByTitle($search)
    {
        return Wallet::query()
            ->where(function ($query) use ($search) {
                $query->where('is_active', 1)->where('title', 'LIKE', ['%' . $search . '%']);
            })->get();
    }

    public function withdraw($user_wallet, $amount, $description = '')
    {
        if ($amount > $user_wallet->balance) {
            return FALSE;
        }

        $transaction = new UserWalletTransaction();
        $transaction->fill([
            'description' => $description,
            'creator_id' => Auth::id(),
            'wallet_id' => $user_wallet->wallet_id,
            'user_id' => $user_wallet->user_id,
        ]);
        $transaction->amount = -1 * $amount;
        $transaction->save();

        return $transaction;
    }

    public function deposit($user_wallet, $amount, $wallet_id, $user_id,  $description = '')
    {
        if (!isset($user_wallet)) {
            $user_wallet = new UserWallet();
            $user_wallet->user_id = $user_id;
            $user_wallet->wallet_id = $wallet_id;
            $user_wallet->balance = $amount;
            $user_wallet->save();
        }

        $transaction = new UserWalletTransaction();
        $transaction->fill([
            'description' => $description,
            'creator_id' => Auth::id(),
            'wallet_id' => $wallet_id,
            'user_id' => $user_id,
        ]);
        $transaction->amount = $amount;
        $transaction->save();

        return $transaction;
    }

}
