<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manufacturer extends Model
{
    protected $fillable = [
        'eng_translit_title',
        'title',
        'url'
    ];

    public function product(): HasMany
    {
        return $this->hasMany('App\Product');
    }
}
