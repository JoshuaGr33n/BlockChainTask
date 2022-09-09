<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymentmethod extends Model
{
    protected $guarded = [];
    protected $table = "payment_method";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
