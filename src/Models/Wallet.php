<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title' , 'name' , 'is_active'
    ];

    public function getIsActiveLabelAttribute()
    {
        switch ($this->is_active) {
            case '0':
                $label = 'غیر‌فعال';
                break;

            case '1':
                $label = 'فعال';
                break;

            default:
                $label = 'نامشخص';
        }
        return $label;
    }
}
