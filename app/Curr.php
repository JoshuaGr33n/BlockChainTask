<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curr extends Model
{
    protected $guarded = [];
    protected $table = "currency";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
