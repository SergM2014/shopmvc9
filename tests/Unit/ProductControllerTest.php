<?php

namespace Tests\Unit;

use App\Product;
use Illuminate\View\View;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;
use App\Repositories\ProductRepo;
use Illuminate\Http\Request;
use App\Repositories\CommentRepo;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\ProductController;

class ProductControllerTest extends TestCase
{
    use PHPMock;

    protected function setUp(): void
    {
        $this->mockFactory = $this->createMock(Factory::class);
        app()->instance(Factory::class, $this->mockFactory);
    }

    public function testShow()
    {
        $this->mockFactory->expects($this->once())
            ->method('make')
            ->with('custom.product.show')
            ->willReturn($this->createMock(View::class));

        $product = $this->createMock(Product::class);
        $product->method('__get')->with('id')->willReturn(1);

        $productRepo = $this->getMockBuilder(ProductRepo::class)
            ->onlyMethods(['getComments', 'sortImages'])
            ->getMock();
        $productRepo->expects($this->once())
            ->method('sortImages')
            ->with($product)
            ->willReturn($product);

        $DbCollection = $this->createMock(\Illuminate\Database\Eloquent\Collection::class);
        $productRepo->expects($this->once())
            ->method('getComments')
            ->willReturn($DbCollection);;

        $commentRepo = $this->getMockBuilder(CommentRepo::class)
            ->onlyMethods(['getCommentTreeStructure'])
            ->getMock();
        $commentRepo->expects($this->once())
            ->method('getCommentTreeStructure');

        (new ProductController())->show($product, $productRepo, $commentRepo);
    }

    public function testShowPreview()
    {
        $this->mockFactory->expects($this->once())
            ->method('make')
            ->with('custom.partials.productPreview')
            ->willReturn($this->createMock(View::class));

        $request = $this->createMock(Request::class);
        $request->expects($this->any())->method('__get')->with('id')->willReturn($this->createMock(Request::class));
        app()->instance('request', $request);

        $DbCollection = $this->createMock(\Illuminate\Database\Eloquent\Collection::class);

        $productRepo = $this->getMockBuilder(ProductRepo::class)
            ->onlyMethods(['getProduct'])
            ->getMock();
        $productRepo->expects($this->once())
            ->method('getProduct')
            ->willReturn($DbCollection);


        (new ProductController())->showPreview( $productRepo);
    }
}
