<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Manufacturer;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $leftCatalogMenu = Category::getLeftCatalogMenu();
        $manufacturers = Manufacturer::all();
        return view('custom.product.show', compact('product', 'leftCatalogMenu', 'manufacturers'));
    }
}
