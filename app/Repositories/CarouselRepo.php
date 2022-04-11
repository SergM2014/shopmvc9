<?php

namespace App\Repositories;

use App\Carousel;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\CarouselRepositoryInterface;

class CarouselRepo implements CarouselRepositoryInterface
{
    public function getAll(): Collection
    {
        return Carousel::all();
    }
}