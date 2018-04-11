<?php

namespace VendingDroid\Seeder;

use Illuminate\Database\Seeder;

use DB;

class ProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('products')->delete();

        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'มาม่า หมูสับ',
                'name_en' => 'Mama Pock',
                'price' => 10.00,
                'stock' => 50,
            ],
            [
                'category_id' => 1,
                'name' => 'มาม่า ต้มยำ',
                'name_en' => 'Mama Tomyum',
                'price' => 10.00,
                'stock' => 50,
            ],
            [
                'category_id' => 2,
                'name' => 'โค้ก',
                'name_en' => 'Coke',
                'price' => 10.00,
                'stock' => 50,
            ],
            [
                'category_id' => 2,
                'name' => 'เป็ปซี่',
                'name_en' => 'Pepsi',
                'price' => 10.00,
                'stock' => 50,
            ],
            [
                'category_id' => 3,
                'name' => 'เลย์',
                'name_en' => 'Lay',
                'price' => 10.00,
                'stock' => 50,
            ],
            [
                'category_id' => 3,
                'name' => 'เทสโต',
                'name_en' => 'Testo',
                'price' => 10.00,
                'stock' => 50,
            ],
            [
                'category_id' => 4,
                'name' => 'ยาดม',
                'name_en' => 'Yah Dom',
                'price' => 10.00,
                'stock' => 50,
            ],
            [
                'category_id' => 4,
                'name' => 'ยาหม่อง',
                'name_en' => 'Yah Mhong',
                'price' => 10.00,
                'stock' => 50,
            ],
        ]);
    }

}
