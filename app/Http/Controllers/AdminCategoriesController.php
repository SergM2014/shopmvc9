<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        $dropDownList = Category::getAdminCategoriesList();
       return view('admin.categories.all', compact('dropDownList'));
    }
}
