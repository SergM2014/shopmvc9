<?php

namespace App\Repositories;

use App\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepo implements CategoryRepositoryInterface
{

    public function getVerticalMenu(): string
    {
        return Category::getVerticalMenu();
    }
}