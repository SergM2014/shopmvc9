<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Product;
use Illuminate\View\View;

class CatalogController extends Controller
{

    private function findOutOrder(?string $order): array
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

    public function index(string $order = null): View
    {
        $orderVariables = $this->findOutOrder($order);
        $catalogResults = Product::orderBy(...$orderVariables)->paginate(10);

        return view('custom.catalog.index', compact( 'catalogResults'));
    }


    public function showCategories($category, string $order = 'default' ): View
    {
        $orderVariables = $this->findOutOrder($order);
        $catalogResults = Product::orderBy(...$orderVariables)->whereHas('categories', function($query)use($category){
                     $query->where('title', $category);
              })->paginate(10);

        return view('custom.catalog.categories', compact( 'catalogResults') );
    }

    public function showManufacturers($manufacturer, $order = null ): View
    {
        $orderVariables = $this->findOutOrder($order);
        $catalogResults = Product::orderBy(...$orderVariables)->whereHas('manufacturer', function($query) use ($manufacturer){
                          $query->where('title', $manufacturer);
                     })->paginate(10);

        return view('custom.catalog.manufacturers', compact('catalogResults') );
    }

}
