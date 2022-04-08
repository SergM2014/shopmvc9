<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function findResults(): View
    {
       $searchResults =  Product::search(request('search'))->paginate(5);

       return view('custom.partials.searchResultsContent', compact('searchResults'));
    }
}
