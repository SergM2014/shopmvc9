<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\JsonResponse;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\ImagesController;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use phpmock\phpunit\PHPMock;

class ImagesControllerTest extends TestCase
{
    use PHPMock;

    public static $functions;

    public function setUp(): void
    {
        $this->jsonMockFactory = $this->createMock(ResponseFactory::class);
        app()->instance(ResponseFactory::class, $this->jsonMockFactory);
        $this->jsonMockFactory->expects($this->once())
            ->method('json')
            ->willReturn( $this->createMock(JsonResponse::class));

        parent::setUp();
    }

    public function testUploadAvatar()
    {
        $uploadedImage = $this->createMock(UploadedFile::class);

        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('file')
            ->with('file')
            ->willReturn($uploadedImage);

        $uploadedImage->expects($this->once())
            ->method('getClientOriginalName');

        app()->instance('path.public', 'some/folder/totest');

        $interventionImage = $this->getMockBuilder(\Intervention\Image\Image::class)
            ->addMethods(['resize'])
            ->onlyMethods((['save']))
            ->getMock();
        $interventionImage->expects($this->any())
            ->method('resize')
            ->willReturn($interventionImage);
        $interventionImage->expects($this->any())
            ->method('save')
            ->willReturn($interventionImage);

        $getImage = $this->getMockBuilder(ImagesController::class)
            ->onlyMethods(['getImage'])
             ->getMock();

        $getImage->expects($this->any())
            ->method('getImage')
            ->with($uploadedImage)
            ->willReturn($interventionImage);

        app()->instance('image', $getImage);

       Image::shouldReceive('make')
            ->once()
            ->andReturn($interventionImage);

        (new ImagesController())->uploadAvatar($request);;
    }

    public function testDeleteAvatar()
    {
        (new ImagesController())->deleteAvatar();
    }
}