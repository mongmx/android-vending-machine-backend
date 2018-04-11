<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// use VendingDroid\Seeder\CategoryTableSeeder;
// use VendingDroid\Seeder\ProductTableSeeder;
use VendingDroid\Seeder\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(CategoryTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
