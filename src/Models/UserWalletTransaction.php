<?php

namespace Modules\Wallet\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWalletTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'creator_id', 'wallet_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id', 'id');
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class,'wallet_id', 'id');
    }

    public function getCreditorLabelAttribute()
    {
        $amount = ($this->amount > 0) ? $this->amount : 0;
        return $amount;
    }

    public function getDebtorLabelAttribute()
    {
        $amount = ($this->amount < 0) ? $this->amount : 0;
        return $amount * -1;
    }
}
