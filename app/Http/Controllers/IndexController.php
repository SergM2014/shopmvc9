<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Repositories\SliderRepo;
use App\Repositories\CarouselRepo;
use App\Repositories\CategoryRepo;
use App\Repositories\BackgroundRepo;

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

    public function aboutUs(BackgroundRepo $background): View
    {
        $aboutUs = $background->aboutUs();

        return view('custom.aboutUs', compact( 'aboutUs') );
    }

    public function downloads(BackgroundRepo $background): View
    {
        $downloads = $background->downloads();

        return view('custom.downloads', compact( 'downloads') );
    }

    public function contacts(BackgroundRepo $background): View
    {
        $contacts = $background->contacts();

        return view('custom.contacts', compact('contacts') );
    }
}
