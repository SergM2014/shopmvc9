<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Searchable;

    protected $fillable = ['author', 'title', 'description', 'body', 'price', 'manufacturer_id'];

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


    public static function getCreateProductImagesArray()
    {

        if(!empty(old('imagesData'))) {
            $imagesArray = explode(',', old('imagesData'));

            return $imagesArray;
        }
        return;
    }




}
