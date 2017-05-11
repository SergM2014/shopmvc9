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

        $catalogResults = Product::orderBy('author', 'DESC')->paginate(10);

        $manufacturers = Manufacturer::all();

        return view('custom.catalog', compact('leftCatalogMenu', 'catalogResults', 'manufacturers' ) );

    }

    public function showCategories($category)
    {
        $leftCatalogMenu = Category::getLeftCatalogMenu();

        $catalogResults = Product::orderBy('author', 'DESC')->whereHas('categories', function($query)use($category){
            $query->where('title', $category);
        })->paginate(10);

        $manufacturers = Manufacturer::all();

        return view('custom.catalog', compact('leftCatalogMenu', 'catalogResults', 'manufacturers' ) );
    }

    public function showManufacturers($manufacturer)
    {
        $leftCatalogMenu = Category::getLeftCatalogMenu();

        $catalogResults = Product::orderBy('author', 'DESC')->whereHas('manufacturer', function($query) use ($manufacturer){
            $query->where('title', $manufacturer);
        })->paginate(10);

        $manufacturers = Manufacturer::all();

        return view('custom.catalog', compact('leftCatalogMenu', 'catalogResults', 'manufacturers' ) );
    }

}
