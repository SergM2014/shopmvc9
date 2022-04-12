<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepo implements ProductRepositoryInterface
{
    public function getProduct(Request $id): Collection
    {
        return Product::find(request('id'));
    }
}