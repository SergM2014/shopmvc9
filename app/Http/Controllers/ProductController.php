<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Product;
use Illuminate\View\View;
use App\Repositories\ProductRepo;
use App\Repositories\CommentRepo;

class ProductController extends Controller
{
    public function show(Product $product, ProductRepo $productRepo, CommentRepo $commentRepo): View
    {
        $productId = $product->id;
        $product = $productRepo->sortImages($product);
        $comments = $productRepo->getComments($productId);
        $parentId = $comments->min('parent_id');
        $treeComments = $commentRepo->getCommentTreeStructure($parentId, $comments);

        return view('custom.product.show', compact('product', 'treeComments'));
    }

    public function showPreview(ProductRepo $productRepo)
    {
        $product = $productRepo->getProduct(request('id'));

        return view('custom.partials.productPreview', compact('product'));
    }

}
