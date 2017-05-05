<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $leftCatalogMenu = Category::getLeftCatalogMenu();

        $catalogResults = Product::paginate(10);

        return view('custom.catalog', compact('leftCatalogMenu', 'catalogResults' ) );

    }
}
