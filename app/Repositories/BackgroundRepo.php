<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Background;
use App\Interfaces\BackgroundRepositoryInterface;

class BackgroundRepo implements BackgroundRepositoryInterface
{

    public function aboutUs(): string
    {
        return Background::first()->aboutUs();
    }
}