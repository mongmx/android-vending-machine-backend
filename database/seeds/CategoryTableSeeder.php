<?php

namespace VendingDroid\Seeder;

use Illuminate\Database\Seeder;

use DB;

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            [
                'name' => 'อาหาร',
            ],
            [
                'name' => 'เครื่องดื่ม',
            ],
            [
                'name' => 'ขนม',
            ],
            [
                'name' => 'เบ็ดเตล็ด',
            ],
        ]);
    }

}
