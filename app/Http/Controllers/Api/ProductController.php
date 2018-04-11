<?php

namespace VendingDroid\Http\Controllers\Api;

use VendingDroid\Http\Controllers\Controller;
use VendingDroid\Models\Category;

use Request;
use Response;

class ProductController extends Controller
{

    public function getProductList()
    {
        $categories = array();

        foreach (Category::all() as $key => $category) {
            $categories[$key] = json_decode(json_encode($category), true);
            $products = array();
            foreach ($category->products as $item) {
                if ($item->stock > 5) {
                    array_push($products, $item);
                }
            }
            $categories[$key]['products'] = $products;
        }

        return Response::json($categories);
        // send to mobile with
        // [
        //     {
        //         "id": "1",
        //         "name": "อาหารสำเร็จรูป",
        //         "status": null,
        //         "created_at": "-0001-11-30 00:00:00",
        //         "updated_at": "2016-04-14 09:33:38",
        //         "products": [
        //             {
        //                 "id": "92",
        //                 "category_id": "1",
        //                 "name": "วุ้นเส้น",
        //                 "name_en": "vermicelli",
        //                 "price": "10.00",
        //                 "stock": "47",
        //                 "stock_min": "15",
        //                 "stock_max": "50",
        //                 "status": null,
        //                 "created_at": "-0001-11-30 00:00:00",
        //                 "updated_at": "2016-04-01 10:58:23",
        //                 "deleted_at": null
        //             },
        //             {
        //                 ...
        //             }
        //         ]
        //     },
        //     {
        //         "id": "2",
        //         "name": "ขนม",
        //         "status": null,
        //         "created_at": "-0001-11-30 00:00:00",
        //         "updated_at": "-0001-11-30 00:00:00",
        //         "products": [
        //             {
        //                 ...
        //             },
        //             {
        //                 ...
        //             }
        //         ]
        //     },
        //     {
        //         ...
        //     }
        // ]
    }

}
