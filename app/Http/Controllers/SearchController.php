<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    public function findResults()
    {

       $searchResults =  Product::search(request('search'))->paginate(5);
       return view('custom.partials.searchResultsContent', compact('searchResults'));
    }
}
