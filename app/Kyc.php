<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    protected $guarded = ['id'];

    protected $table = "kycs";
}

