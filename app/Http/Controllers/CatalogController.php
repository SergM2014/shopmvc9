<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Manufacturer;

class CatalogController extends Controller
{
    public function index()
    {
        $leftCatalogMenu = Category::getLeftCatalogMenu();

        $catalogResults = Product::paginate(10);

        $manufacturers = Manufacturer::all();

        return view('custom.catalog', compact('leftCatalogMenu', 'catalogResults', 'manufacturers' ) );

    }
}
