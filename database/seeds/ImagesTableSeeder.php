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

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo2.jpg',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo3.jpg',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo4.jpg',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo5.jpg',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo6.jpg',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo7.jpg',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo8.jpg',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo9.jpg',

        ]);
        DB::table('images')->insert([
            'product_id'          => '1',
            'path'              => 'photo10.jpg',

        ]);
    }
}
