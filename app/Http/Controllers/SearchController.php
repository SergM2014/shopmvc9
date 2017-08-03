<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    public function findResults()
    {
//return var_dump($_POST);
       $searchResults =  Product::search($_POST['search'])->paginate(5);
       return view('custom.partials.searchResultsContent', compact('searchResults'));
    }
}
