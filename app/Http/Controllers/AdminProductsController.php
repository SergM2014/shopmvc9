<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class AdminProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(config('app.perPageAdmin'));
        $page = $_GET['page']??  1;
        $tableCounter = ($page-1)* config('app.perPageAdmin');
        return view('admin.products.all', compact('products', 'tableCounter'));
    }

    public function show()
    {

    }


    public function edit()
    {

    }
}
