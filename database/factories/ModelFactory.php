<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {

    $faker = Faker\Factory::create('uk_UA');

    return [
        'author' => $faker->name,
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'body' => $faker->text,
        'price' => $faker->numberBetween($min = 1000, $max = 90000),
        'manufacturer_id' =>$faker->numberBetween($min = 1, $max = 3),


    ];
});

$factory->define(App\Background::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('uk_UA');

    return [
        'aboutUs' => $faker->text,
        'downloads' => $faker->text,
        'contacts' => $faker->text
    ];
});


$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    $faker = Faker\Factory::create('uk_UA');

    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'product_id' => $faker->numberBetween($min = 1, $max = 50),
        'parent_id' => $faker->numberBetween($min = 1, $max = 50),
        'comment' => $faker->text,
        'published' => '1',
        'changed' =>'0'

    ];
});






