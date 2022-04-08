<?php

declare(strict_types=1);

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use Searchable;

    protected $fillable = ['author', 'title', 'description', 'body', 'price', 'manufacturer_id', 'category_id'];

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'author' => $this->author,
            'title' => $this->title,
            'description' => $this->description
             ];
    }

    public static function getCreateProductImagesArray(Collection $imagesObj = null): array
    {
        if(old('_token')){
            if(!empty(old('imagesData'))) {
                $imagesArray = explode(',', old('imagesData'));
                return $imagesArray;
             }

             return [];
        }

        if(!$imagesObj) return [];

        if($imagesObj->get()->isNotEmpty()){
                    return  $imagesObj->pluck('path')->toArray();
                }
            return [];
    }
}
