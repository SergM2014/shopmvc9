<?php

namespace Tests\Unit;

use App\Product;
use Illuminate\View\View;
use PHPUnit\Framework\TestCase;
use App\Repositories\SliderRepo;
use App\Repositories\ProductRepo;
use App\Repositories\CommentRepo;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\ProductController;

class ProductControllerTest extends TestCase
{
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

        $productRepo = $this->getMockBuilder(ProductRepo::class)
            ->onlyMethods(['sortImages', 'getComments'])
            ->getMock();
        $productRepo->expects($this->once())
            ->method('sortImages')
            ->with($product)
            ->willReturn($product);

        $productRepo->expects($this->once())
            ->method('getComments');

        $commentRepo = $this->getMockBuilder(CommentRepo::class)
            ->onlyMethods(['getCommentTreeStructure'])
            ->getMock();
        $commentRepo->expects($this->once())
            ->method('getCommentTreeStructure');

        (new ProductController())->show($product, $productRepo, $commentRepo);
    }
}
