<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function manufacturer()
    {
        return $this->belongsTo('App\Manufacturer');
    }

    public function images(){

        return $this->hasMany('App\Image');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
