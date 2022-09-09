<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawMethod extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'user_data' => 'object',
    ];
}
