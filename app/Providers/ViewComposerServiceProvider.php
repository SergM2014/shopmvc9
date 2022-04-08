<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Manufacturer;
use App\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['custom.partials.catalogDropdownMenu', 'custom.partials.header'], function($view){
            $view->with('currentRoute', Route::currentRouteName());
            $view->with('linkParametr',Arr::first(Route::current()->parameters()));
        });

        view()->composer('custom.partials.customLeftMenu', function($view){
            $view->with('leftCatalogMenu', Category::getLeftCatalogMenu());
            $view->with('manufacturers',Manufacturer::all());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
