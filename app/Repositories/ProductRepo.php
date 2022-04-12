<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Product;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepo implements ProductRepositoryInterface
{
    public function getProduct(Request $id): Collection
    {
        return Product::find(request('id'));
    }

    public function sortImages(Product $product): Product
    {
        if($product->images->isNotEmpty()){
            $images =   $product->images->sortBy('order');
            $images->values()->all();
            $product->images= $images;
        }
        return $product;
    }

    public function getComments(int $productId): Collection
    {
        return Comment::where('product_id', $productId)->get();
    }

    public function findItems(?array $keys): Collection
    {
        return Product::find($keys);
    }

    public function getPrice(int $id): int
    {
        return Product::find($id)->price;
    }

    public function paginate(array $orderVariables,int $number,): LengthAwarePaginator
    {
       return Product::orderBy(...$orderVariables)->paginate(10);
    }

    public function getCategories(array $orderVariables, string $category, int $number): LengthAwarePaginator
    {
        return Product::orderBy(...$orderVariables)->whereHas('categories', function($query)use($category){
            $query->where('title', $category);
        })->paginate($number);
    }

    public function getManufacturers(array $orderVariables, string $manufacturer, int $number): LengthAwarePaginator
    {
        return Product::orderBy(...$orderVariables)->whereHas('manufacturer', function($query) use ($manufacturer){
            $query->where('title', $manufacturer);
        })->paginate($number);
    }
}