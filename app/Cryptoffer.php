<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptoffer extends Model
{
    protected $guarded = [];
    protected $table = "crypto_offers";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
