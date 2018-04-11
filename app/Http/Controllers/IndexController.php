<?php

namespace VendingDroid\Http\Controllers;

use Illuminate\Http\Request;

use VendingDroid\Http\Requests;
use VendingDroid\Http\Controllers\Controller;
use VendingDroid\Models\Product;
use VendingDroid\Models\Category;

class IndexController extends Controller
{

    public function index()
    {
        // show page /resources/views/index
        return view('index');
    }

    public function intro()
    {
        // show page /resources/views/intro
        return view('intro');
    }

    public function products()
    {
        // $products = Product::all()->sortBy('category_id')->sortBy('id');
        $products = Product::orderBy('category_id', 'ASC')->orderBy('id', 'ASC')->get();
        $categories = Category::all();

        // show page /resources/views/products/list
        return view('products.list', compact('products','categories'));
    }

    public function search($query)
    {
        $products = Product::search($query)->get()->sortBy('id');
        $categories = Category::all();

        // show page /resources/views/products/list
        return view('products.list', compact('products','categories'));
    }

    public function category($id)
    {
        $products = Product::whereCategoryId($id)->get()->sortBy('id');
        $categories = Category::all();

        // show page /resources/views/products/list
        return view('products.list', compact('products','categories'));
    }

}
