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

   public function testShowCategories()
    {
        $this->mockFactory->expects($this->once())
            ->method('make')
            ->with('custom.catalog.categories')
            ->willReturn($this->createMock(View::class));

        $productRepo = $this->getMockBuilder(ProductRepo::class)
            ->onlyMethods(['getCategories'])
            ->getMock();
        $productRepo->expects($this->once())
            ->method('getCategories');

        (new CatalogController())->showCategories($productRepo, 'category1');
    }

    public function showManufacturers()
    {
        $this->mockFactory->expects($this->once())
            ->method('make')
            ->with('custom.catalog.manufacturers')
            ->willReturn($this->createMock(View::class));

        $productRepo = $this->getMockBuilder(ProductRepo::class)
            ->onlyMethods(['getManufacturers'])
            ->getMock();
        $productRepo->expects($this->once())
            ->method('getManufacturers');

        (new CatalogController())->getManufacturers($productRepo, 'siemens');
    }
}
