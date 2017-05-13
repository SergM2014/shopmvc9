<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'IndexController@index');
Route::get('/catalog/{order?}', 'CatalogController@index')->name('catalog');
Route::get('/catalog/category/{category}/{order?}', 'CatalogController@showCategories')->name('catalogCategories');
Route::get('/catalog/manufacturer/{manufacturer}/{order?}', 'CatalogController@showManufacturers')->name('catalogManufacturers');

