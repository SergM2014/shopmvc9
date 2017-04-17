<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Carousel;
use App\Category;


class IndexController extends Controller
{

public function index()
    {
        $sliders = Slider::all();

        $carousels = Carousel::all();

       // $categoriesVertMenu = Category::getVerticalMenu();

        return view('index', compact('sliders', 'carousels'/*, 'categoriesVertMenu'*/) );
    }

    }
