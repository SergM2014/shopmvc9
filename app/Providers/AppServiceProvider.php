<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

       view()->composer(['custom.partials.catalogDropdownMenu', 'custom.partials.header'], function($view){
            $view->with('currentRoute', Route::currentRouteName());
            $view->with('linkParametr',array_first(\Route::current()->parameters()));
       });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
