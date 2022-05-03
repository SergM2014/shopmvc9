<?php

namespace Tests\Unit;

use Illuminate\View\View;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use PHPUnit\Framework\TestCase;
use App\Repositories\ProductRepo;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Session\SessionManager;
use App\Http\Controllers\BusketController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Routing\ResponseFactory;

class BusketControllerTest extends TestCase
{
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

    public function testUpdateHeader(): void
    {
        $jsonMockFactory = $this->createMock(ResponseFactory::class);
        app()->instance(ResponseFactory::class, $jsonMockFactory);
        $jsonMockFactory->expects($this->once())
            ->method('json')
            ->willReturn( $this->createMock(JsonResponse::class));

        (new BusketController())->updateHeader();
    }

    public function testAdd(): void
    {
        $request = $this->createMock(Request::class);

        $session = $this->getMockBuilder(Store::class)
            ->onlyMethods(['get','put'])
            ->disableOriginalConstructor()
            ->getMock();
        $session->expects($this->any())
            ->method('get');
        $session->expects($this->exactly(3))
            ->method('put');
        app()->instance('session', $session);

        $jsonMockFactory = $this->createMock(ResponseFactory::class);
        $jsonMockFactory->expects($this->once())
            ->method('json')
            ->willReturn( $this->createMock(JsonResponse::class));
        app()->instance(ResponseFactory::class, $jsonMockFactory);

         (new BusketController())->add($request);
    }
}