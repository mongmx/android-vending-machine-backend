<?php

namespace VendingDroid\Http\Controllers;

use Illuminate\Http\Request;

use VendingDroid\Http\Requests;
use VendingDroid\Http\Controllers\Controller;
use VendingDroid\Models\Product;
use VendingDroid\Models\Category;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        // show page /resources/views/products/index
        return view('products.index', compact('products','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        // show page /resources/views/products/create
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->category_id = $request->input('category');
        $product->name = $request->input('name');
        $product->name_en = $request->input('name_en');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->stock_min = $request->input('min');
        $product->stock_max = $request->input('max');
        $product->save();

        // link to page http://domain.com/product
        return redirect('/product')->with('ok');
    }

    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        // show page /resources/views/products/edit
        return view('products.edit', compact('product', 'categories'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        // show page /resources/views/products/edit
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->category_id = $request->input('category');
        $product->name = $request->input('name');
        $product->name_en = $request->input('name_en');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->stock_min = $request->input('min');
        $product->stock_max = $request->input('max');
        $product->save();

        // link to page http://domain.com/product
        return redirect('/product')->with('ok');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        // link to page http://domain.com/product
        return redirect('/product')->with('ok');
    }

    public function search($query)
    {
        $products = Product::search($query)->get()->sortBy('id');
        $categories = Category::all();

        // show page /resources/views/products/index
        return view('products.index', compact('products','categories'));
    }

    public function category($id)
    {
        $products = Product::whereCategoryId($id)->get()->sortBy('id');
        $categories = Category::all();

        // show page /resources/views/products/index
        return view('products.index', compact('products','categories'));
    }

}
