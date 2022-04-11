<?php

namespace App\Repositories;

use App\Slider;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\SliderRepositoryInterface;

class SliderRepo implements SliderRepositoryInterface
{
    public function  getAll(): Collection
    {
        return Slider::all();
    }
}