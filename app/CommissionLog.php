<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionLog extends Model
{
    protected $guarded = ['id'];

    protected $table = "commission_logs";

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function bywho(){
        return $this->belongsTo('App\User','who','id');
    }
}
