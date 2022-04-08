<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BusketController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AdminCommentsController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminManufacturersController;

Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale()], function() {

    Route::get('/', [IndexController::class , 'index'])->name('index');
    Route::get('/catalog/all/{order?}', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/catalog/category/{category}/{order?}', [CatalogController::class, 'showCategories'])->name('catalogCategories');
    Route::get('/catalog/manufacturer/{manufacturer}/{order?}', [CatalogController::class, 'showManufacturers'])->name('catalogManufacturers');
    Route::get('/aboutUs', [IndexController::class, 'aboutUs'])->name('aboutUs');
    Route::get('/downloads', [IndexController::class, 'downloads'])->name('downloads');
    Route::get('/contacts', [IndexController::class, 'contacts'])->name('contacts');
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('catalogShowProduct');

//    Route::get('/product/{product}', function () {
//        return 'Hello World';
//    });

    Route::post('/busket/add', [BusketController::class, 'add']);
    Route::post('/busket/show', [BusketController::class, 'show']);
    Route::post('/busket/update', [BusketController::class, 'update']);

    Route::post('/updateSmallBusket', [BusketController::class, 'updateHeader']);
    Route::post('/showOrderForm', [BusketController::class,'showOrderForm']);
    Route::post('/validateBusket', [BusketController::class, 'validateBusketContent']);
    Route::post('/busket/makeOrder', [BusketController::class, 'makeOrder']);
    Route::post('/succeededOrder', [BusketController::class, 'succeededOrder']);
    Route::post('/sendSuccessMail', [BusketController::class, 'sendSuccessEmail']);

    Route::post('/images/uploadAvatar', [ImagesController::class, 'uploadAvatar']);
    Route::post('/images/deleteAvatar', [ImagesController::class, 'deleteAvatar']);
    Route::post('/images/uploadProductImage', [ImagesController::class, 'uploadProductImage']);
    Route::post('/images/deleteProductImage', [ImagesController::class, 'deleteProductImage']);

    Route::post('/comment/add', [CommentController::class, 'add']);
    Route::post('/refreshCaptcha', function () {
        return view('custom.partials.captcha');
    });
    Route::post('/getCommentForResponse', [CommentController::class, 'getCommentForResponse']);

    Route::post('/searchResults', [SearchController::class, 'findResults']);
    Route::post('/showProductPreview', [ProductController::class, 'showPreview']);


    Route::post('/getImage', function () {
        return view('admin.products.drawImage');
    });


    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

        Route::get('products/succeeded', function () {
            return view('admin.succeeded');
        });
        Route::post('products/popupMenu', function () {
            return view('admin.popUp.allProducts');
        });
        Route::post('products/confirmWindow', function () {
            return view('admin.modal.deleteProduct');
        });

        Route::resource('products', AdminProductsController::class);

        Route::post('categories/popupMenu', function () {
            return view('admin.popUp.allCategories');
        });
        Route::post('categories/confirmWindow', [AdminCategoriesController::class, 'showConfirmWindow']);
        Route::get('categories/succeeded', function () {
            return view('admin.succeeded');
        });

        Route::resource('categories', AdminCategoriesController::class);

        Route::post('comments/popupMenu', function () {
            return view('admin.popUp.allComments');
        });
        Route::post('comments/{comment}/publish', [AdminCommentsController::class, 'publish']);
        Route::post('comments/{comment}/unpublish', [AdminCommentsController::class, 'unpublish']);
        Route::get('comments/succeeded', function () {
            return view('admin.succeeded');
        });
        Route::post('comments/confirmWindow', [AdminCommentsController::class, 'showConfirmWindow']);

        Route::resource('comments', AdminCommentsController::class);

        Route::post('manufacturers/popupMenu', function () {
            return view('admin.popUp.allManufacturers');
        });
        Route::post('manufacturers/confirmWindow', [AdminManufacturersController::class, 'showConfirmWindow']);
        Route::get('manufacturers/succeeded', function () {
            return view('admin.succeeded');
        });
        Route::resource('manufacturers', AdminManufacturersController::class);


        Route::post('users/popupMenu', function () {
            return view('admin.popUp.allUsers');
        });
        Route::post('users/confirmWindow', [AdminUsersController::class, 'showConfirmWindow']);
        Route::get('users/succeeded', function () {
            return view('admin.succeeded');
        });
        Route::resource('users', AdminUsersController::class);


        Route::get('/', [HomeController::class, 'index']);
    });


    Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');

}); //end language sector

//define language
Route::get('setlocale/{lang}', function ($lang) {

    $referer = Redirect::back()->getTargetUrl(); //URL предыдущей страницы
    $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

    //разбиваем на массив по разделителю
    $segments = explode('/', $parse_url);

    //Если URL (где нажали на переключение языка) содержал корректную метку языка
    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::$languages)) {

        unset($segments[1]); //удаляем метку
    }

    //Добавляем метку языка в URL (если выбран не язык по-умолчанию)
    if ($lang != App\Http\Middleware\LocaleMiddleware::$mainLanguage){
        array_splice($segments, 1, 0, $lang);
    }

    //формируем полный URL
    $url = Request::root().implode("/", $segments);

    //если были еще GET-параметры - добавляем их
    if(parse_url($referer, PHP_URL_QUERY)){
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url); //Перенаправляем назад на ту же страницу

})->name('setlocale');


//examples of usage
/*href="/{{ App\Http\Middleware\LocaleMiddleware::printLink() }}/login"*/

