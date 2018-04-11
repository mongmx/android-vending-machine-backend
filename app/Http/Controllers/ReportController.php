<?php

namespace VendingDroid\Http\Controllers;

use VendingDroid\Http\Controllers\Controller;
use DB;
use VendingDroid\Models\Category;
use VendingDroid\Models\Product;
use VendingDroid\Models\Order;

class ReportController extends Controller
{

    public function index()
    {
        // $orderItems = DB::table('order_items')
        //         ->join('products', 'products.id', '=', 'order_items.product_id')
        //         ->select(
        //             'products.name as name',
        //             'products.id as id',
        //             'products.price as price',
        //             'products.status as status',
        //             'products.stock as stock',
        //             DB::raw('SUM(quantity) as total_sales')
        //         )
        //         ->groupBy('product_id')
        //         ->orderBy('total_sales', 'desc')
        //         ->get();
        $orderItems = DB::select( DB::raw("select products.name as name, products.id as id, products.price as unitprice, (products.price * SUM(quantity)) as price, products.status as status, products.stock as stock, SUM(quantity) as total_sales from order_items inner join products on products.id = order_items.product_id where order_items.created_at BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59' group by product_id order by total_sales desc") );
        $lessProduct = DB::select( DB::raw("select products.id as id, products.name as name, products.stock_min as min, products.stock_max as max, products.stock as stock, (products.stock_max - products.stock) as need FROM products WHERE products.stock <= products.stock_min AND products.deleted_at IS NULL") );
        $categories = Category::all();
        $total = 0;
        foreach ($orderItems as $item) {
            $total += $item->price;
        }
        $totalcoin = DB::select( DB::raw("select SUM(total) as totalcoin from orders where orders.status = 2 AND orders.created_at BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59'") )[0]->totalcoin;
        $totalcash = DB::select( DB::raw("select SUM(total) as totalcash from orders where orders.status = 5 AND orders.created_at BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59'") )[0]->totalcash;

        $totalByCate = null;
        foreach ($categories as $key => $c) {
            $totalByCate[$key]['name'] = $c->name;
            $totalByCate[$key]['total'] = 0;
            foreach ($c->products as $p) {
                foreach ($orderItems as $i) {
                    if ($p->id == $i->id) {
                        $totalByCate[$key]['total'] += $i->price;
                    }
                }
            }
        }

        // show page /resources/views/report/index
        return view('report.index', compact('orderItems', 'categories', 'lessProduct', 'total', 'totalcoin', 'totalcash', 'totalByCate'));
    }

    public function history($d, $m, $y)
    {
        $orderItems = DB::select( DB::raw("select products.name as name, products.id as id, products.price as unitprice, (products.price * SUM(quantity)) as price, products.status as status, products.stock as stock, SUM(quantity) as total_sales from order_items inner join products on products.id = order_items.product_id where order_items.created_at BETWEEN '{$y}-{$m}-{$d} 00:00:00' AND '{$y}-{$m}-{$d} 23:59:59' group by product_id order by total_sales desc") );
        $lessProduct = DB::select( DB::raw("select products.id as id, products.name as name, products.stock_min as min, products.stock_max as max, products.stock as stock, (products.stock_max - products.stock) as need FROM products WHERE products.stock <= products.stock_min AND products.deleted_at IS NULL") );
        $categories = Category::all();
        $h_date = "{$d}/{$m}/{$y}";
        $total = 0;
        foreach ($orderItems as $item) {
            $total += $item->price;
        }
        $totalcoin = DB::select( DB::raw("select SUM(total) as totalcoin from orders where orders.status = 2 AND orders.created_at BETWEEN '{$y}-{$m}-{$d} 00:00:00' AND '{$y}-{$m}-{$d} 23:59:59'") )[0]->totalcoin;
        $totalcash = DB::select( DB::raw("select SUM(total) as totalcash from orders where orders.status = 5 AND orders.created_at BETWEEN '{$y}-{$m}-{$d} 00:00:00' AND '{$y}-{$m}-{$d} 23:59:59'") )[0]->totalcash;

        $totalByCate = null;
        foreach ($categories as $key => $c) {
            $totalByCate[$key]['name'] = $c->name;
            $totalByCate[$key]['total'] = 0;
            foreach ($c->products as $p) {
                foreach ($orderItems as $i) {
                    if ($p->id == $i->id) {
                        $totalByCate[$key]['total'] += $i->price;
                    }
                }
            }
        }

        // show page /resources/views/report/index
        return view('report.index', compact('orderItems', 'categories', 'lessProduct', 'h_date', 'total', 'totalcoin', 'totalcash', 'totalByCate'));
    }

    public function resetQueue()
    {
        DB::statement("UPDATE orders SET queue=0, status=2 WHERE queue > 0");

        // link to page http://domain.com/product
        return redirect('/product')->with('status', 'Reset queue completed!');
    }

    // public function search($query)
    // {
    //     $products = Product::search($query)->get()->sortBy('id');
    //     $lessProduct = Product::where('stock', '<', 15)->get();
    //     $categories = Category::all();
    //     return view('report.index', compact('orderItems','categories', 'lessProduct'));
    // }

    public function category($id)
    {
        // $orderItems = DB::table('order_items')
        //         ->join('products', 'products.id', '=', 'order_items.product_id')
        //         ->select(
        //             'products.name as name',
        //             'products.id as id',
        //             'products.price as price',
        //             'products.status as status',
        //             'products.stock as stock',
        //             DB::raw('SUM(quantity) as total_sales')
        //         )
        //         ->where('category_id', '=', $id)
        //         ->groupBy('product_id')
        //         ->orderBy('total_sales', 'desc')
        //         ->get();
        $orderItems = DB::select( DB::raw("select products.name as name, products.id as id, products.price as unitprice, (products.price * SUM(quantity)) as price, products.status as status, products.stock as stock, SUM(quantity) as total_sales from order_items inner join products on products.id = order_items.product_id where order_items.created_at BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59' AND category_id=".$id." group by product_id order by total_sales desc") );
        $lessProduct = DB::select( DB::raw("select products.id as id, products.name as name, products.stock_min as min, products.stock_max as max, products.stock as stock, (products.stock_max - products.stock) as need FROM products WHERE products.stock <= products.stock_min AND products.deleted_at IS NULL") );
        $categories = Category::all();
        $total = 0;
        foreach ($orderItems as $item) {
            $total += $item->price;
        }
        $totalcoin = DB::select( DB::raw("select SUM(total) as totalcoin from orders where orders.status = 2 AND orders.created_at BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59'") )[0]->totalcoin;
        $totalcash = DB::select( DB::raw("select SUM(total) as totalcash from orders where orders.status = 5 AND orders.created_at BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59'") )[0]->totalcash;

        $totalByCate = null;

        // show page /resources/views/report/index
        return view('report.index', compact('orderItems', 'categories', 'lessProduct', 'total', 'totalcoin', 'totalcash', 'totalByCate'));
    }

    public function queue()
    {
        $orderQueue = Order::where('queue', '>', 0)
            ->where('status', '<>', 2)
            ->where('status', '<>', 5)
            ->where('status', '<>', 6)
            ->orderBy('id', 'asc')
            ->get();
        foreach ($orderQueue as $key => $order) {
            foreach ($order->orderItems as $item) {
                $item->name = $item->product->name;
            }
            $orderQueue[$key]->id = $order->queue;
        }
        return view('report.queue', compact('orderQueue'));
    }

}
