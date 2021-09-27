<?php

namespace Modules\Wallet\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_wallet_id', 'amount', 'bank_name', 'iban', 'pan', 'acc_num', 'description'];

    public function user_wallet()
    {
        return $this->belongsTo(UserWallet::class);
    }

    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'در انتظار بررسی';
                break;
            case 'cancelled':
                return 'لغو شده';
                break;
            case 'rejected':
                return 'رد شده';
                break;
            case 'completed':
                return 'تکمیل شده';
                break;
            default:
                return 'نامشخض';
                break;
        }
    }
}
