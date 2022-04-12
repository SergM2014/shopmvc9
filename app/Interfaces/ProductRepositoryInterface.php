<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getProduct(Request $id): Collection;
}