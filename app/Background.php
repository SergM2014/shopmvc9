<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    public function scopeAboutUs($query)
    {
        return $query->value('aboutUs');
    }
}
