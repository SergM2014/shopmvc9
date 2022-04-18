<?php

namespace Tests\Unit;

use Illuminate\View\View;
use PHPUnit\Framework\TestCase;
use App\Repositories\ProductRepo;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\CatalogController;

class CatalogControllerTest extends TestCase
{
   public function setUp(): void
   {
       $this->mockFactory = $this->createMock(Factory::class);
       app()->instance(Factory::class, $this->mockFactory);

       parent::setUp();
   }

   public function testIndex()
   {
       $this->mockFactory->expects($this->once())
           ->method('make')
           ->with('custom.catalog.index')
           ->willReturn($this->createMock(View::class));

       $productRepo = $this->getMockBuilder(ProductRepo::class)
           ->onlyMethods(['paginate'])
           ->getMock();
       $productRepo->expects($this->once())
           ->method('paginate');

       (new CatalogController())->index($productRepo);
   }
}
