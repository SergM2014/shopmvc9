<?php

declare(strict_types=1);

namespace App\Interfaces;

interface BackgroundRepositoryInterface
{
    public function aboutUs(): string;

    public function downloads(): string;

    public function contacts(): string;
}