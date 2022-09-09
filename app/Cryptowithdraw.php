<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptowithdraw extends Model
{
    protected $guarded = [];
    protected $table = "cryptowithdraws";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
