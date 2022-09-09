<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $guarded = [];
    protected $table = "currencies";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
