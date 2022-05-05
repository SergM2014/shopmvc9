<?php

namespace App\Interfaces;

use App\Order;

interface OrderRepositoryInterface
{
    public function create(array $validated, array $order): Order;
}