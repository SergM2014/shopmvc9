<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Carousel;
use App\Category;
use App\Background;
use App\Manufacturer;


class IndexController extends Controller
{

    public function index()
    {
        $sliders = Slider::all();

        $carousels = Carousel::all();

        $categoriesVertMenu = Category::getVerticalMenu();

        return view('custom.index', compact('sliders', 'carousels', 'categoriesVertMenu') );
    }

    public function aboutus()
    {
        $leftCatalogMenu = Category::getLeftCatalogMenu();
        $manufacturers = Manufacturer::all();
        $aboutUs = Background::first()->aboutUs();

        return view('custom.aboutUs', compact('leftCatalogMenu', 'manufacturers', 'aboutUs') );
    }


}
