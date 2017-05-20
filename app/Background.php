<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    public function scopeAboutUs($query)
    {
        return $query->value('aboutUs');
    }

    public function scopeDownloads($query)
    {
        return $query->value('downloads');
    }

    public function scopeContacts($query)
    {
        return $query->value('contacts');
    }
}
