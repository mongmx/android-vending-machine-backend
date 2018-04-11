<?php

namespace VendingDroid\Http\Controllers;

use Illuminate\Http\Request;

use VendingDroid\Http\Requests;
use VendingDroid\Http\Controllers\Controller;
use VendingDroid\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        // show page /resources/views/category/index
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        // show page /resources/views/category/create
        return view('category.create');
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        // link to page http://domain.com/manage-category
        return redirect('/manage-category')->with('ok');
    }

    public function show($id)
    {
        $category = Category::find($id);

        // show page /resources/views/category/edit
        return view('category.edit', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::find($id);

        // show page /resources/views/category/edit
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        // link to page http://domain.com/manage-category
        return redirect('/manage-category')->with('ok');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        // link to page http://domain.com/manage-category
        return redirect('/manage-category')->with('ok');
    }

}
