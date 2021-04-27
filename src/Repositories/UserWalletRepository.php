<?php


namespace Wallet\Repositories;


use Wallet\Models\UserWalletTransaction;
use Wallet\Models\Wallet;

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

}
