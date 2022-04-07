<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 50)->create();

        DB::table('category_product')->insert([
            'product_id' => '1',
            'category_id'=> '1',
        ]);

        DB::table('category_product')->insert([
            'product_id' => '1',
            'category_id'=> '2',
        ]);
        DB::table('category_product')->insert([
            'product_id' => '1',
            'category_id'=> '3',
        ]);
    }
}
