<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Searchable;

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

    public function toSearchableArray()
    {
        return [
            'author' => $this->author,
            'title' => $this->title,
            'description' => $this->description

             ];
        }




}
