<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Order;
use App\Interfaces\OrderRepositoryInterface;

class OrderRepo implements OrderRepositoryInterface
{

    public function create(array $validated, array $order ): Order
    {
        return  Order::create(['name'=> $validated['name'], 'phone'=> $validated['phone'], 'email'=> $validated['email'],
            'order'=>json_encode($order), 'delivered'=>'0']);
    }
}
