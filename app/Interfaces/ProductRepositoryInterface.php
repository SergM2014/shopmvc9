<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function getProduct(Request $id): Collection;

    public function sortImages(Product $product): Product;

    public function getComments(int $productId): Collection;

    public function findItems(array $keys): Collection;

    public function getPrice(int $id): int;

    public function paginate(array $orderVariables, int $number): LengthAwarePaginator;

    public function getCategories(array $orderVariables, string $category): LengthAwarePaginator;
}