<?php

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/catalog/all/{order?}', 'CatalogController@index')->name('catalog');
    Route::get('/catalog/category/{category}/{order?}', 'CatalogController@showCategories')->name('catalogCategories');
    Route::get('/catalog/manufacturer/{manufacturer}/{order?}', 'CatalogController@showManufacturers')->name('catalogManufacturers');

