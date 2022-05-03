<?php

namespace Tests\Unit;

use App\Product;
use Illuminate\View\View;
use PHPUnit\Framework\TestCase;
use App\Repositories\ProductRepo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Session\SessionManager;
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

    public function testSucceededOrder(): void
    {
        $mockFactory = $this->createMock(Factory::class);
        app()->instance(Factory::class, $mockFactory);
        $mockFactory->expects($this->once())
            ->method('make')
            ->with('custom.partials.succeededOrder')
            ->willReturn($this->createMock(View::class));

        (new BusketController())->succeededOrder();
    }

    public function testShow(): void
    {
        $viewClass = $this->createMock(View::class);
        $viewClass->expects($this->once())
            ->method('with')
            ->willReturn($this->createMock(View::class));

        $mockFactory = $this->createMock(Factory::class);
        $mockFactory->expects($this->once())
            ->method('make')
            ->with('custom.modalWindow.bigBusketContent')
             ->willReturn($viewClass);

        app()->instance(Factory::class, $mockFactory);

        $DbCollection = $this->createMock(Collection::class);

        $productRepo = $this->getMockBuilder(ProductRepo::class)
            ->onlyMethods(['findItems'])
            ->getMock();
        $productRepo->expects($this->once())
            ->method('findItems')
            ->willReturn($DbCollection);

        $session = $this->getMockBuilder(SessionManager::class)
            ->addMethods(['get'])
            ->disableOriginalConstructor()
            ->getMock();
        $session->expects($this->once())
            ->method('get')
            ->willReturn([]);


        app()->instance('session', $session);

        (new BusketController())->show($productRepo);
    }
}