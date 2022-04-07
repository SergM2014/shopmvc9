<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarouselTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carousels')->insert([
            'image' => 'carrier.gif',
            'url' => '/carousel1',
        ]);

        DB::table('carousels')->insert([
            'image' => 'ch.gif',
            'url' => '/carousel2',
        ]);

        DB::table('carousels')->insert([
            'image' => 'daikin.gif',
            'url' => '/carousel3',
        ]);

        DB::table('carousels')->insert([
            'image' => 'fujitsu.gif',
            'url' => '/carousel4',
        ]);

        DB::table('carousels')->insert([
            'image' => 'gree.gif',
            'url' => '/carousel5',
        ]);

        DB::table('carousels')->insert([
            'image' => 'mitsubishi.gif',
            'url' => '/carousel6',
        ]);

        DB::table('carousels')->insert([
            'image' => 'panasonic.gif',
            'url' => '/carousel7',
        ]);

        DB::table('carousels')->insert([
            'image' => 'site1.gif',
            'url' => '/carousel8',
        ]);

        DB::table('carousels')->insert([
            'image' => 'site2.gif',
            'url' => '/carousel9',
        ]);

        DB::table('carousels')->insert([
            'image' => 'telo.gif',
            'url' => '/carousel10',
        ]);

        DB::table('carousels')->insert([
            'image' => 'toshiba.gif',
            'url' => '/carousel11',
        ]);

        DB::table('carousels')->insert([
            'image' => 'general_climat.gif',
            'url' => '/carousel12',
        ]);
    }
}
