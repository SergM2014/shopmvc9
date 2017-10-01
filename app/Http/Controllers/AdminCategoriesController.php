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

    public function create()
    {
        $dropDownList = Category::getCategoryDropDownList(null);
        return view('admin.categories.create', compact('dropDownList'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>'required|min:6',
        ]);

        Category::create(['title' => request('title'),
            'parent_id'=>request('parentId')]);

        return redirect('/admin/categories/succeeded')->with('status', 'Category Created!');
    }

}
