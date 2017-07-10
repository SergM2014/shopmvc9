<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(CarouselTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(ManufacturersTableSeeder::class);
        $this->call(BackgroundsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
