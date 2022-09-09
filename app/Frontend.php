<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Frontend extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'data_values' => 'object'
    ];

    public function getKeyAttribute(){
        return $this->data_keys;
    }

    public function getValueAttribute(){
        return $this->data_values;
    }

    public static function scopeGetContent($key)
    {
        return Frontend::where('data_keys', $key);
    }
}
