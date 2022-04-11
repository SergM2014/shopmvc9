<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface SliderRepositoryInterface
{
    public function getAll(): Collection;
}