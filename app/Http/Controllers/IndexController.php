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
        $aboutUs = Background::first()->aboutUs();

        return view('custom.aboutUs', compact( 'aboutUs') );
    }

    public function downloads()
    {
        $downloads = Background::first()->downloads();

        return view('custom.downloads', compact( 'downloads') );
    }


    public function contacts()
    {
        $contacts = Background::first()->contacts();

        return view('custom.contacts', compact('contacts') );
    }


}
