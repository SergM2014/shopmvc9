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
        $comments = Comment::where('product_id', $id)->get();
        $parentId = $comments->min('parent_id');

        $treeComments = Comment::getCommentsTreeStructure($parentId, $comments);

        return view('custom.product.show', compact('product', 'treeComments'));
    }
}
