<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CarouselRepositoryInterface
{
    public function getAll(): Collection;
}