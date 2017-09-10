<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Manufacturer;

class AdminProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(config('app.perPageAdmin'));
        $page = $_GET['page']??  1;
        $tableCounter = ($page-1)* config('app.perPageAdmin');
        return view('admin.products.all', compact('products', 'tableCounter'));
    }

    public function create()
    {
        $manufacturers = Manufacturer::all();
        $images = Product::getCreateProductImagesArray();

        return view('admin.products.create', compact('manufacturers', 'images'));
    }

    public function store(Request $request)
    {
       $this->validate($request, [
            'author' => 'required|min:6',
            'title' =>'required|min:6',
            'description' => 'required',
            'body' =>'required',
            'price' => 'required|numeric',
        ]);

       $product = Product::create($request->all());


        if(!empty(request('imagesData'))) {

            $imagesArray = explode(',', request('imagesData'));

            for ($i=0; $i < count($imagesArray); $i++) {

                $product->images()->create([
                    'path' => $imagesArray[$i],
                    'order' => $i
                ]);

            }
        }


        return redirect('/admin/product/created')->with('status', 'Product Created!');
    }

        public function show()
    {
        return 'show';
    }


    public function edit()
    {
        return 'edit';
    }


}
