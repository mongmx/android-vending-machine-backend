<?php

namespace VendingDroid\Http\Controllers\Api;

use Request;
use Response;

use VendingDroid\Http\Requests;
use VendingDroid\Http\Controllers\Controller;
use VendingDroid\Models\Order;
use VendingDroid\Models\OrderItem;
use VendingDroid\Models\Product;

class OrderController extends Controller
{

    public function postOrder()
    {
        $request = Request::all();
        $total = 0;

        $lastOrder = Order::orderBy('id', 'desc')->first();

        $order = new Order();
        $order->queue = (is_null($lastOrder)) ? 1 : $lastOrder->queue + 1;
        $order->total = $total;
        $order->status = 0;
        $order->save();

        $orderStatus = 1;

        foreach ($request as $data) {
            $item = new OrderItem();
            $item->order_id = $order->id;
            $item->product_id = $data['id'];
            $item->quantity = $data['qty'];
            $item->subtotal = $data['price'];
            $item->status = $data['status'];
            $orderStatus = $data['status'];
            $item->save();
            $total += $data['price'];

            $product = Product::find($data['id']);
            $product->stock = $product->stock - $data['qty'];
            $product->save();
        }

        $order->total = $total;
        $order->status = $orderStatus;
        $order->save();

        $orderQueue = Order::find($order->id);
        foreach ($orderQueue->orderItems as $item) {
            $item->name = $item->product->name_en;
            $item->price = $item->product->price;
        }
        $orderQueue->id = $orderQueue->queue;

        return Response::json($orderQueue);
        // send to mobile with
        // {
        //     "id": "29",
        //     "queue": "29",
        //     "total": "0.00",
        //     "status": "1",
        //     "created_at": "2016-04-19 07:19:25",
        //     "updated_at": "2016-04-19 07:19:25",
        //     "order_items": [
        //         {
        //             "id": "161",
        //             "order_id": "106",
        //             "product_id": "134",
        //             "quantity": "1",
        //             "subtotal": "10.00",
        //             "status": "3",
        //             "created_at": "2016-04-18 09:15:40",
        //             "updated_at": "2016-04-18 09:15:40",
        //             "name": "ขนม ตะวัน",
        //             "product": {
        //                 "id": "134",
        //                 "category_id": "2",
        //                 "name": "ขนม ตะวัน",
        //                 "name_en": "Tawan Snacks",
        //                 "price": "10.00",
        //                 "stock": "42",
        //                 "stock_min": "15",
        //                 "stock_max": "50",
        //                 "status": null,
        //                 "created_at": "-0001-11-30 00:00:00",
        //                 "updated_at": "2016-04-18 09:15:40",
        //                 "deleted_at": null
        //             }
        //         }
        //     ]
        // }
    }

    public function getOrderQueue()
    {
        $orderQueue = Order::where('status', 1)
            ->orWhere('status', 3)
            ->orWhere('status', 4)
            ->orWhere('status', 7)
            ->orWhere('status', 8)
            ->orderBy('id', 'asc')
            ->get();
        foreach ($orderQueue as $key => $order) {
            foreach ($order->orderItems as $item) {
                $item->name = $item->product->name;
            }
            $orderQueue[$key]->id = $order->queue;
        }

        return Response::json($orderQueue);
        // send to mobile with
        // [
        //     {
        //         "id": "28",
        //         "queue": "28",
        //         "total": "22.00",
        //         "status": "3",
        //         "created_at": "2016-04-18 09:15:40",
        //         "updated_at": "2016-04-18 09:15:40",
        //         "order_items": [
        //             {
        //                 "id": "161",
        //                 "order_id": "106",
        //                 "product_id": "134",
        //                 "quantity": "1",
        //                 "subtotal": "10.00",
        //                 "status": "3",
        //                 "created_at": "2016-04-18 09:15:40",
        //                 "updated_at": "2016-04-18 09:15:40",
        //                 "name": "ขนม ตะวัน",
        //                 "product": {
        //                     "id": "134",
        //                     "category_id": "2",
        //                     "name": "ขนม ตะวัน",
        //                     "name_en": "Tawan Snacks",
        //                     "price": "10.00",
        //                     "stock": "42",
        //                     "stock_min": "15",
        //                     "stock_max": "50",
        //                     "status": null,
        //                     "created_at": "-0001-11-30 00:00:00",
        //                     "updated_at": "2016-04-18 09:15:40",
        //                     "deleted_at": null
        //                 }
        //             }
        //         ]
        //     }
        // ]
    }

    public function postCloseOrderQueue()
    {
        $queueId = Request::json('id');
        $queueStatus = Request::json('status');
        $order = Order::where('queue', $queueId)->first();
        // $order->status = 2;
        $order->status = $queueStatus;
        $order->save();
        foreach ($order->orderItems as $item) {
            // $item->status = 2;
            $item->status = $queueStatus;
            $item->save();
        }

        // send to mobile with
        // {
        //     "queue": "29",
        //     "status": "2"
        // }
        return Response::json(array('queue'=>$queueId, 'status'=>$queueStatus));
    }

}
