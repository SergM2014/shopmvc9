<?php

namespace Tests\Unit;

use Illuminate\View\View;
use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\BusketController;
use Illuminate\Database\Eloquent\Collection;

class BusketControllerTest extends TestCase
{
    protected function setUp(): void
    {


        parent::setUp();
    }

    public function testShowOrderForm(): void
    {
        $mockFactory = $this->createMock(Factory::class);
        app()->instance(Factory::class, $mockFactory);
        $mockFactory->expects($this->once())
            ->method('make')
            ->with('custom.modalWindow.orderForm')
            ->willReturn($this->createMock(View::class));

        (new BusketController())->showOrderForm();
    }

    public function testSucceededOrder():void
    {
        $mockFactory = $this->createMock(Factory::class);
        app()->instance(Factory::class, $mockFactory);
        $mockFactory->expects($this->once())
            ->method('make')
            ->with('custom.partials.succeededOrder')
            ->willReturn($this->createMock(View::class));

        (new BusketController())->succeededOrder();
    }
}