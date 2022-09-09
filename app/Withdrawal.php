<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }




    public function method()
    {
        return $this->belongsTo(WithdrawMethod::class, 'method_id');
    }

    public function wallet()
    {
        return $this->belongsTo(UserWallet::class, 'wallet_id');
    }


    public function scopePending()
    {
        return $this->where('status', 0);
    }

    public function scopeApproved()
    {
        return $this->where('status', 1);
    }

    public function scopeRejected()
    {
        return $this->where('status', 2);
    }
}
