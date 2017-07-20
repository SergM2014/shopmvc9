<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Comment;


class ProductController extends Controller
{
    public function show(Product $product)
    {

        $id = $product->id;

        $comments = comment::all();

        $treeComments = Comment::getCommentsTreeStructure($id, $comments);


        return view('custom.product.show', compact('product', 'treeComments'));
    }
}
