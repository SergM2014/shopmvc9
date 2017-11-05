<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'eng_translit_title',
        'title',
        'url'
    ];

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
