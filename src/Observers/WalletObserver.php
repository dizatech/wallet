<?php

namespace Modules\Wallet\Observers;

use Modules\Wallet\Events\WalletDepositEvent;
use Modules\Wallet\Facades\UserWalletFacade;
use Modules\Wallet\Models\UserWallet;
use Modules\Wallet\Models\UserWalletTransaction;
use Modules\Wallet\Models\Wallet;

class WalletObserver
{
    public function created(UserWalletTransaction $transaction)
    {
        if( $transaction->amount > 0 ){
            WalletDepositEvent::dispatch($transaction);
        }
        $user_wallet = UserWallet::where('user_id', $transaction->user_id)
            ->where('wallet_id', $transaction->wallet_id)
            ->first();
        if( is_null( $user_wallet ) ){ //No wallet exists for this user
            $user_wallet = new UserWallet();
            $user_wallet->user_id = $transaction->user_id;
            $user_wallet->wallet_id = $transaction->wallet_id;
            $user_wallet->balance = $transaction->amount;
            $transaction->balance = $transaction->amount;
        }
        else{
            $balance = UserWalletTransaction::whereUserId($transaction->user_id)
            ->whereWalletId($transaction->wallet_id)
            ->sum('amount');
            $user_wallet->balance = $balance;
            $transaction->balance = $balance;
        }
        $transaction->save();
        $user_wallet->save();
    }

}
