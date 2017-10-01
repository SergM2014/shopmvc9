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

    public function edit(Category $category)
    {
        $parentId = old('_token')? old('parentId'): $category->parent_id;

        $dropDownList = Category::getUpdateCategoryDropDownList($parentId,  $category->id);

        $id = $category->id;

        return view('admin.categories.edit', compact('dropDownList', 'category', 'id'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' =>'required|min:6',
        ]);

       // dd('this is update action');
//now update the given category Instanse
        $id = request('id');
       $category = Category::find($id);
       $category->parent_id = request('parentId');
       $category->title = request('title');
       $category->save();
        return redirect('/admin/categories/succeeded')->with('status', 'Category Updated!');

    }

}
