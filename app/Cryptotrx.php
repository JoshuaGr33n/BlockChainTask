<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptotrx extends Model
{
    protected $guarded = [];
    protected $table = "cryptotrxs";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
