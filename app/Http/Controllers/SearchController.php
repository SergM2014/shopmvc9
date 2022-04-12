<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Product;
use Illuminate\View\View;
use App\Repositories\ProductRepo;

class SearchController extends Controller
{
    public function findResults(ProductRepo $productRepo): View
    {
        $searchResults = $productRepo->search(5);

       return view('custom.partials.searchResultsContent', compact('searchResults'));
    }
}
