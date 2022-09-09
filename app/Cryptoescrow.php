<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptoescrow extends Model
{
    protected $guarded = [];
    protected $table = "crypto_escrows";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
