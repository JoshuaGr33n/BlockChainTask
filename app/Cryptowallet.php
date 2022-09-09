<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptowallet extends Model
{
    protected $guarded = [];
    protected $table = "cryptowallets";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
