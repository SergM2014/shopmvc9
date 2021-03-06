<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Comment;


class ProductController extends Controller
{
    public function show(Product $product )
    {
        $id = $product->id;

        $product = $this->sortImages($product);

        $comments = Comment::where('product_id', $id)->get();
        $parentId = $comments->min('parent_id');

        $treeComments = Comment::getCommentsTreeStructure($parentId, $comments);

        return view('custom.product.show', compact('product', 'treeComments'));
    }

    public function showPreview()
    {
        $product = Product::find(request('id'));

        return view('custom.partials.productPreview', compact('product'));

    }


    private function sortImages(Product $product)
    {
        if($product->images->isNotEmpty()){
            $images =   $product->images->sortBy('order');
            $images->values()->all();
            $product->images= $images;
        }
        return $product;
    }

}
