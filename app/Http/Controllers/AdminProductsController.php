<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
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
        $categoriesDropDownList = Category::getCategoryDropDownList(old('categoryId'));

        return view('admin.products.create', compact('manufacturers', 'images', 'categoriesDropDownList'));
    }


    public function store(Request $request)
    {

       $this->validate($request, [
            'author' => 'required|min:6',
            'title' =>'required|min:6',
            'description' => 'required',
            'body' =>'required',
            'price' => 'required|numeric',
            'categoryId'=>'required'
        ]);

       $product = Product::create(['author' => request('author'), 'title' => request('title'),
           'description' => request('description'), 'body'=>request('body'), 'price'=>request('price'),
           'manufacturer_id'=>request('manufacturerId')]);


        $this->addProductImages($product);


        $this->attachCategories($product);


        return redirect('/admin/product/susseeded')->with('status', 'Product Created!');
    }



    public function show(Product $product)
    {
        return $product;
    }



    public function edit(Product $product)
    {
        $manufacturers = Manufacturer::all();
        $images = Product::getCreateProductImagesArray($product->images());
        $categoriesDropDownList = Category::getCategoryDropDownList(old('categoryId')?? $product->categories()->pluck('id')->toArray());

        return view('admin.products.update', compact('manufacturers', 'images', 'product', 'categoriesDropDownList'));
    }


    public function update($productId, Request $request)
    {

        $this->validate($request, [
            'author' => 'required|min:6',
            'title' =>'required|min:6',
            'description' => 'required',
            'body' =>'required',
            'price' => 'required|numeric',
            'categoryId'=>'required'
        ]);


        $product = Product::find($productId);
        Product::find($productId)->update(['author' => request('author'), 'title' => request('title'),
            'description' => request('description'), 'body'=>request('body'), 'price'=>request('price'),
            'manufacturer_id'=>request('manufacturerId')]);


        Image::where('product_id', $productId)->delete();

        $this->addProductImages($product);




        return redirect('/admin/product/succeeded')->with('status', 'Product Updated!');

    }

    /**
     * @param $product
     */
    private function addProductImages($product)
    {
        if (!empty(request('imagesData'))) {

            $imagesArray = explode(',', request('imagesData'));

            for ($i = 0; $i < count($imagesArray); $i++) {

                $product->images()->create([
                    'path' => $imagesArray[$i],
                    'order' => $i
                ]);
            }
        }
    }

    /**
     * @param $product
     */
    private function attachCategories($product)
    {
        if (!empty(request('categoryId'))) {

            foreach (request('categoryId') as $categoryId) {

                $product->categories()->attach($categoryId);

            }
        }
    }


}
