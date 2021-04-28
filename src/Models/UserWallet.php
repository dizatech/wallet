<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;
    protected $table = 'user_wallet';


    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
