<?php

use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacturers')->insert([
            'eng_translit_title' => 'siemens',
            'title'              => 'siemens',
            'url'                => '/siemens',
        ]);

        DB::table('manufacturers')->insert([
            'eng_translit_title' => 'audi',
            'title'              => 'audi',
            'url'                => '/audi',
        ]);
        DB::table('manufacturers')->insert([
            'eng_translit_title' => 'agf',
            'title'              => 'agf',
            'url'                => '/agf',
        ]);
    }
}
