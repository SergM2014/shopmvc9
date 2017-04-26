<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CatalogController extends Controller
{
    public function index()
    {
        $leftCatalogMenu = Category::getLeftCatalogMenu();

        $catalogModel= new DB_Catalog();
        $catalogResults = $catalogModel->getCatalog();
        $manufacturersList = $catalogModel->getManufacturers();
        $pages = $catalogModel->countPages();



        return view('custom.catalog', compact('leftCatalogMenu', 'catalogResults', 'manufacturersList', 'pages' ) );

    }
}
