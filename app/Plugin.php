<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'shortcode' => 'object',
    ];

    public function scopeGenerateScript()
    {
        $script = $this->script;
        foreach ($this->shortcode as $key => $item) {
            $script = shortcode_replacer('{{' . $key . '}}', $item->value, $script);
        }
        return $script;
    }
}
