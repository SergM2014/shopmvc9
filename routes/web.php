<?php

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/catalog/all/{order?}', 'CatalogController@index')->name('catalog');
    Route::get('/catalog/category/{category}/{order?}', 'CatalogController@showCategories')->name('catalogCategories');
    Route::get('/catalog/manufacturer/{manufacturer}/{order?}', 'CatalogController@showManufacturers')->name('catalogManufacturers');
    Route::get('/aboutus', 'IndexController@aboutus')->name('aboutus');
    Route::get('/downloads', 'IndexController@downloads')->name('downloads');
    Route::get('/contacts', 'IndexController@contacts')->name('contacts');

