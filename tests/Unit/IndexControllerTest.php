<?php

namespace Tests\Unit;

use Illuminate\View\View;
use App\Repositories\BackgroundRepo;
use Illuminate\Contracts\View\Factory;
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
        $this->mockFactory = $this->createMock(Factory::class);
        app()->instance(Factory::class, $this->mockFactory);
    }

    public function testIndex(): void
    {
        $this->mockFactory->expects($this->any())
            ->method('make')
            ->with('custom.index')
            ->willReturn($this->createMock(View::class));

        $slider = $this->getMockBuilder(SliderRepo::class)
            ->onlyMethods(['getAll'])
            ->getMock();
        $slider->expects($this->once())
            ->method('getAll');

        $carousel = $this->getMockBuilder(CarouselRepo::class)
            ->onlyMethods(['getAll'])
            ->getMock();
        $carousel->expects($this->once())
            ->method('getAll');

        $category = $this->getMockBuilder(CategoryRepo::class)
            ->onlyMethods(['getVerticalMenu'])
            ->getMock();
        $category->expects($this->once())
            ->method('getVerticalMenu');

        (new IndexController())->index($slider, $carousel, $category);
    }

    public function testAboutUs(): void
    {
        $this->mockFactory->expects($this->any())
            ->method('make')
            ->with('custom.aboutUs')
            ->willReturn($this->createMock(View::class));

        $background = $this->getMockBuilder(BackgroundRepo::class)
            ->onlyMethods(['aboutUs'])
            ->getMock();
        $background->expects($this->once())
            ->method('aboutUs');

        (new IndexController())->aboutUs($background);
    }
}
