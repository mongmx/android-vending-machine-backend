<?php

namespace VendingDroid\Seeder;

use Illuminate\Database\Seeder;

use DB;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
            [
                'name' => 'user',
                'email' => 'user@mail.com',
                'password' => bcrypt('cnx053'),
                'role' => 'user',
            ],
        ]);
    }

}
