<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Product;
use App\Comment;
use Illuminate\View\View;
use App\Repositories\ProductRepo;

class ProductController extends Controller
{
    public function show(Product $product, ProductRepo $productRepo): View
    {
        $id = $product->id;
        $product = $productRepo->sortImages($product);
        $comments = Comment::where('product_id', $id)->get();
        $parentId = $comments->min('parent_id');
        $treeComments = Comment::getCommentsTreeStructure($parentId, $comments);

        return view('custom.product.show', compact('product', 'treeComments'));
    }

    public function showPreview(ProductRepo $productRepo)
    {
        $product = $productRepo->getProduct(request('id'));
        return view('custom.partials.productPreview', compact('product'));
    }

}
