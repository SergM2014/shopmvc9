<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo1.jpg',
            'order'             => '1',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo2.jpg',
            'order'             => '2',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo3.jpg',
            'order'             => '3',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo4.jpg',
            'order'             => '4',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo5.jpg',
            'order'             => '5',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo6.jpg',
            'order'             => '6',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo7.jpg',
            'order'             => '7',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo8.jpg',
            'order'             => '8',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo9.jpg',
            'order'             => '9',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo10.jpg',
            'order'             => '10',

        ]);
    }
}
