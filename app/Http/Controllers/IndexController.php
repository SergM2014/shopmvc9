<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Background;
use Illuminate\View\View;
use App\Repositories\SliderRepo;
use App\Repositories\CarouselRepo;
use App\Repositories\CategoryRepo;

class IndexController extends Controller
{
    public function index(
        SliderRepo $slider,
        CarouselRepo $carousel,
        CategoryRepo $category
    ): View
    {
        $sliders = $slider->getAll();
        $carousels = $carousel->getAll();
        $categoriesVertMenu = $category->getVerticalMenu();

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
