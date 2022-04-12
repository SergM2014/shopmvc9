<?php

namespace Tests\Unit;

use Illuminate\View\Factory;
use PHPUnit\Framework\TestCase;
use App\Repositories\SliderRepo;
use App\Repositories\CarouselRepo;
use App\Repositories\CategoryRepo;
use App\Http\Controllers\IndexController;
use Mockery\MockInterface;

class IndexControllerTest extends TestCase
{
    protected function setUp(): void
    {
        $this->slider = $this->getMockBuilder(SliderRepo::class)
            ->onlyMethods(['getAll'])
            ->getMock();
        $this->slider->expects($this->once())
            ->method('getAll');

        $this->carousel = $this->getMockBuilder(CarouselRepo::class)
            ->onlyMethods(['getAll'])
            ->getMock();
        $this->carousel->expects($this->once())
            ->method('getAll');

        $this->category = $this->getMockBuilder(CategoryRepo::class)
            ->onlyMethods(['getVerticalMenu'])
            ->getMock();
        $this->category->expects($this->once())
            ->method('getVerticalMenu');
    }

    public function test_index(): void
    {
      $index = new IndexController();

      $index->index($this->slider, $this->carousel, $this->category);


    }

}
