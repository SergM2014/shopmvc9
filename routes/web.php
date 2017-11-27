<?php

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/catalog/all/{order?}', 'CatalogController@index')->name('catalog');
    Route::get('/catalog/category/{category}/{order?}', 'CatalogController@showCategories')->name('catalogCategories');
    Route::get('/catalog/manufacturer/{manufacturer}/{order?}', 'CatalogController@showManufacturers')->name('catalogManufacturers');
    Route::get('/aboutus', 'IndexController@aboutus')->name('aboutus');
    Route::get('/downloads', 'IndexController@downloads')->name('downloads');
    Route::get('/contacts', 'IndexController@contacts')->name('contacts');
    Route::get('/product/{product}', 'ProductController@show')->name('catalogShowProduct');

    Route::post('/busket/add', 'BusketController@add');
    Route::post('/busket/show', 'BusketController@show');
    Route::post('/busket/update', 'BusketController@update');

    Route::post('/updateSmallBusket', 'BusketController@updateHeader');
    Route::post('/showOrderForm', 'BusketController@showOrderForm');
    Route::post('/validateBusket', 'BusketController@validateBusketContent');
    Route::post('/busket/makeOrder', 'BusketController@makeOrder');
    Route::post('/succeededOrder', 'BusketController@succeededOrder');
    Route::post('/sendSuccessMail', 'BusketController@sendSuccessEmail');

    Route::post('/images/uploadAvatar', 'ImagesController@uploadAvatar');
    Route::post('/images/deleteAvatar', 'ImagesController@deleteAvatar');
    Route::post('/images/uploadProductImage', 'ImagesController@uploadProductImage');
    Route::post('/images/deleteProductImage', 'ImagesController@deleteProductImage');

    Route::post('/comment/add', 'CommentController@add');
    Route::post('/refreshCaptcha', function(){ return view('custom.partials.captcha'); });
    Route::post('/getCommentForResponse', 'CommentController@getCommentForResponse');

    Route::post('/searchResults', 'SearchController@findResults');
    Route::post('/showProductPreview', 'ProductController@showPreview');



    Route::post('/getImage', function(){ return view('admin.products.drawImage'); });


    Route::group(['prefix'=>'admin', 'middleware'=> 'auth'], function () {

        Route::get('products/succeeded', function () { return view('admin.succeeded'); });
        Route::post('products/popupMenu', function () { return view('admin.popUp.allProducts'); });
        Route::post('products/confirmWindow', function () { return view('admin.modal.deleteProduct'); });

        Route::resource('products', 'AdminProductsController');

        Route::post('categories/popupMenu', function () { return view('admin.popUp.allCategories'); });
        Route::post('categories/confirmWindow', 'AdminCategoriesController@showConfirmWindow');
        Route::get('categories/succeeded', function () { return view('admin.succeeded'); });

        Route::resource('categories', 'AdminCategoriesController');

        Route::post('comments/popupMenu', function () { return view('admin.popUp.allComments'); });
        Route::post('comments/{comment}/publish', 'AdminCommentsController@publish');
        Route::post('comments/{comment}/unpublish', 'AdminCommentsController@unpublish');
        Route::get('comments/succeeded', function () { return view('admin.succeeded'); });
        Route::post('comments/confirmWindow', 'AdminCommentsController@showConfirmWindow');

        Route::resource('comments', 'AdminCommentsController');

        Route::post('manufacturers/popupMenu', function () { return view('admin.popUp.allManufacturers'); });
        Route::post('manufacturers/confirmWindow', 'AdminManufacturersController@showConfirmWindow');
        Route::get('manufacturers/succeeded', function () { return view('admin.succeeded'); });
        Route::resource('manufacturers', 'AdminManufacturersController');


        Route::resource('users', 'AdminUsersController');


        Route::get('/', 'HomeController@index');
    });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
