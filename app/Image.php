<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = [

        'path', 'order'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Product');
    }
}
