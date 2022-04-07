<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'parent_id'          => '0',
            'title'              => 'category1',

        ]);

        DB::table('categories')->insert([
            'parent_id'          => '0',
            'title'              => 'category2',

        ]);

        DB::table('categories')->insert([
            'parent_id'          => '1',
            'title'              => 'category3',

        ]);


        DB::table('categories')->insert([
            'parent_id'          => '1',
            'title'              => 'category4',

        ]);

        DB::table('categories')->insert([
            'parent_id'          => '1',
            'title'              => 'category5',

        ]);

    }
}
