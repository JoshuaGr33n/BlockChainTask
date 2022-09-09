<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $guarded = [];
    protected $table = "trades";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
