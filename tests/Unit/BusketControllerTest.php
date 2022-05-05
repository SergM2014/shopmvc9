<?php

namespace Tests\Unit;

use App\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use PHPUnit\Framework\TestCase;
use App\Repositories\OrderRepo;
use App\Repositories\ProductRepo;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\View\Factory;
use Illuminate\Session\SessionManager;
use App\Http\Requests\OrderFormRequest;
use App\Http\Controllers\BusketController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Routing\ResponseFactory;

class BusketControllerTest extends TestCase
{
    protected static $response;
    protected static $responseOk;
    protected static $orderResponse;

    public static function setUpBeforeClass(): void
    {
        self::$response = [
            'totalAmount' => 1,
            'totalSumma' => 100,
            'success'=> true,
            'busket' => []
        ];
        self::$responseOk = ['success'=> true];
        self::$orderResponse = [
            'totalAmount' => 1,
            'totalSumma' => 100,
            'success'=> true,
            'busket' => [],
            'email' => 'qqq@qq.qq'
        ];

        parent::setUpBeforeClass();
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

    public function testUpdateHeader(): void
    {
        $session = $this->getMockBuilder(Store::class)
            ->onlyMethods(['get'])
            ->disableOriginalConstructor()
            ->getMock();

        $session->expects( $this->any())
            ->method('get')
            ->with($this->logicalOr(
                $this->equalTo('totalAmount'),
                $this->equalTo('totalSumma'),
                $this->equalTo('busketContent')
            ))
            ->will($this->returnCallback(
                fn($param) =>
                match($param) {
                    'totalAmount' => 1,
                    'totalSumma' => 100,
                    'busketContent' => []
                }
            ));
        app()->instance('session', $session);

        $jsonResponse = $this->createMock(JsonResponse::class);
        $jsonResponse->method('getData')
            ->willReturn([
                "totalAmount" => session('totalAmount'),
                "totalSumma" => session('totalSumma'),
                "success"=> true,
                "busket" => session('busketContent')
            ]);

        $jsonMockFactory = $this->createMock(ResponseFactory::class);
        $jsonMockFactory->method('json')
            ->willReturn( $jsonResponse);
        app()->instance(ResponseFactory::class, $jsonMockFactory);

        $expected = (new BusketController())->updateHeader();
        $this->assertInstanceOf(JsonResponse::class, $expected);
        $response = $expected->getData();
        $this->assertIsArray($response);
        $this->assertSame($response, self::$response);

    }

    public function testAdd(): void
    {
        $request = $this->createMock(Request::class);

        $session = $this->getMockBuilder(Store::class)
            ->onlyMethods(['get','put'])
            ->disableOriginalConstructor()
            ->getMock();

        $session->expects( $this->any())
            ->method('get')
            ->with($this->logicalOr(
                $this->equalTo('totalAmount'),
                $this->equalTo('totalSumma'),
                $this->equalTo('busketContent')
            ))
            ->will($this->returnCallback(
                fn($param) =>
                match($param) {
                    'totalAmount' => 1,
                    'totalSumma' => 100,
                    'busketContent' => []
                }
            ));

        $session->expects($this->exactly(3))
            ->method('put');
        app()->instance('session', $session);


        $jsonResponse = $this->createMock(JsonResponse::class);
        $jsonResponse->method('getData')
            ->willReturn([
                "totalAmount" => session('totalAmount'),
                "totalSumma" => session('totalSumma'),
                "success"=> true,
                "busket" => session('busketContent')
            ]);

        $jsonMockFactory = $this->createMock(ResponseFactory::class);
        $jsonMockFactory->method('json')
            ->willReturn( $jsonResponse);
        app()->instance(ResponseFactory::class, $jsonMockFactory);

        $expected = (new BusketController())->add($request);
        $this->assertInstanceOf(JsonResponse::class, $expected);
        $response = $expected->getData();
        $this->assertIsArray($response);
        $this->assertSame($response, self::$response);
    }

    public function testValidateBusketContent(): void
    {
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('__get')
            ->with('busketContent')
            ->willReturn([]);
        app()->instance('request', $request);


        $jsonResponse = $this->createMock(JsonResponse::class);
        $jsonResponse->method('getData')
            ->willReturn([
                "success"=> true,
            ]);

        $jsonMockFactory = $this->createMock(ResponseFactory::class);
        $jsonMockFactory->method('json')
            ->willReturn( $jsonResponse);
        app()->instance(ResponseFactory::class, $jsonMockFactory);

        $expected = (new BusketController())->validateBusketContent();
        $this->assertInstanceOf(JsonResponse::class, $expected);
        $response = $expected->getData();
        $this->assertIsArray($response);
        $this->assertSame($response, self::$responseOk);
    }

    public function testMakeOrder(): void
    {
        $orderFormRequest = $this->getMockBuilder(OrderFormRequest::class)
            ->onlyMethods(['validated'])
            ->getMock();
        $orderFormRequest->expects($this->any())
            ->method('validated')
            ->willReturn([
                'name' => 'Name',
                'phone' => '08000393848',
                'email' => 'qqq@qq.qq'
            ]);
        $validated = $orderFormRequest->validated();

        $session = $this->getMockBuilder(Store::class)
            ->onlyMethods(['get','put'])
            ->disableOriginalConstructor()
            ->getMock();

        $session->expects( $this->any())
            ->method('get')
            ->with($this->logicalOr(
                $this->equalTo('totalAmount'),
                $this->equalTo('totalSumma'),
                $this->equalTo('busketContent')
                ))
            ->will($this->returnCallback(
                fn($param) =>
                   match($param) {
                      'totalAmount' => 1,
                      'totalSumma' => 100,
                      'busketContent' => []
                    }
            ));

        $session->expects($this->exactly(3))
            ->method('put');
        app()->instance('session', $session);

        $orderRepo = $this->getMockBuilder(OrderRepo::class)
            ->onlyMethods(['create'])
            ->getMock();
        $orderRepo->expects($this->once())
             ->method('create');

        Mail::fake();

        $jsonResponse = $this->createMock(JsonResponse::class);
        $jsonResponse->method('getData')
            ->willReturn([
                    'totalAmount' => session('totalAmount'),
                    'totalSumma' => session('totalSumma'),
                    'success' => true,
                    'busket' => session('busketContent'),
                    'email' => $validated['email']
            ]);

        $jsonMockFactory = $this->createMock(ResponseFactory::class);
        $jsonMockFactory->method('json')
            ->willReturn( $jsonResponse);
        app()->instance(ResponseFactory::class, $jsonMockFactory);

        $expected = (new BusketController())->makeOrder($orderFormRequest, $orderRepo);
        $this->assertInstanceOf(JsonResponse::class, $expected);
        $response = $expected->getData();
        $this->assertIsArray($response);
        $this->assertSame($response, self::$orderResponse);
    }
}