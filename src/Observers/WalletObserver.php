<?php

namespace Modules\Wallet\Observers;

use Modules\Wallet\Facades\UserWalletFacade;
use Modules\Wallet\Models\UserWallet;
use Modules\Wallet\Models\UserWalletTransaction;
use Modules\Wallet\Models\Wallet;

class WalletObserver
{
    public function created(UserWalletTransaction $transaction)
    {
        $user_wallet = UserWallet::where('user_id', $transaction->user_id)
            ->where('wallet_id', $transaction->wallet_id)
            ->first();
        if( is_null( $user_wallet ) ){ //No wallet exists for this user
            $user_wallet = new UserWallet();
            $user_wallet->user_id = $transaction->user_id;
            $user_wallet->wallet_id = $transaction->wallet_id;
            $user_wallet->balance = $transaction->amount;
        }
        else{
            $user_wallet->balance += $transaction->amount;
        }
        $user_wallet->save();
    }

}
