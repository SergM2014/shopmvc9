<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            'image' => 'slider1.jpg',
            'url'   => '/slider1',
            'title' => 'slider1'

        ]);

        DB::table('sliders')->insert([
            'image' => 'slider2.jpg',
            'url'   => '/slider2',
            'title' => 'slider2'

        ]);
    }
}
