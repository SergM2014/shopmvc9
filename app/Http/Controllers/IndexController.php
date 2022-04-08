<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Carousel;
use App\Category;
use App\Background;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::all();
        $carousels = Carousel::all();
        $categoriesVertMenu = Category::getVerticalMenu();

        return view('custom.index', compact('sliders', 'carousels', 'categoriesVertMenu') );
    }

    public function aboutUs(): View
    {
        $aboutUs = Background::first()->aboutUs();

        return view('custom.aboutUs', compact( 'aboutUs') );
    }

    public function downloads(): View
    {
        $downloads = Background::first()->downloads();

        return view('custom.downloads', compact( 'downloads') );
    }


    public function contacts(): View
    {
        $contacts = Background::first()->contacts();

        return view('custom.contacts', compact('contacts') );
    }


}
