<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'glove',
            'brand_id' => 1,
            'price' => 22.5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name' => 'jersey',
            'brand_id' => 1,
            'price' => 30,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name' => 'shoe',
            'brand_id' => 2,
            'price' => 50,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name' => 'shirt',
            'brand_id' => 3,
            'price' => 22.5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name' => 'jeans',
            'brand_id' => 4,
            'price' => 72,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name' => 'jacket',
            'brand_id' => 5,
            'price' => 50,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'name' => 'coat',
            'brand_id' => 6,
            'price' => 122.7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
