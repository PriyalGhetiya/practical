<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => Str::random(5),
            'description' => Str::random(15),
            'price' => rand(1,500),
            'category_id' => 1,
            'image' => '1323249215.png'
        ]);
    }
}
