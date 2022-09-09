<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptotradechat extends Model
{
    protected $guarded = [];
    protected $table = "crypto_trade_chat";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
