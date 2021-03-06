<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Manufacturer;

class CatalogController extends Controller
{

    private function findOutOrder($order)
    {
        switch ($order){
            case 'AZ':
                $field = 'title'; $order = 'DESC';
                break;
            case 'ZA':
                $field = 'title'; $order = 'DESC';
                break;
            case 'cheap_first':
                $field = 'price'; $order = 'ASC';
                break;
            case 'expensive_first':
                $field = 'price'; $order = 'DESC';
                break;
            case 'new_first':
                $field = 'created_at'; $order = 'DESC';
                break;
            case 'old_first':
                $field = 'created_at'; $order = 'ASC';
                break;
            default:
                $field = 'title'; $order = 'DESC';
        }
        return [$field, $order];
    }

    public function index($order = null )
    {
        $orderVariables = $this->findOutOrder($order);

        $catalogResults = Product::orderBy(...$orderVariables)->paginate(10);


        return view('custom.catalog.index', compact( 'catalogResults'));
    }


    public function showCategories($category, $order = 'default' )
    {

        $orderVariables = $this->findOutOrder($order);

        $catalogResults = Product::orderBy(...$orderVariables)->whereHas('categories', function($query)use($category){
                     $query->where('title', $category);
              })->paginate(10);


        return view('custom.catalog.categories', compact( 'catalogResults') );
    }


    public function showManufacturers($manufacturer, $order = null )
    {

        $orderVariables = $this->findOutOrder($order);

        $catalogResults = Product::orderBy(...$orderVariables)->whereHas('manufacturer', function($query) use ($manufacturer){
                          $query->where('title', $manufacturer);
                     })->paginate(10);

        return view('custom.catalog.manufacturers', compact('catalogResults') );
    }

}
