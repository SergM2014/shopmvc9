<?php

namespace Tests\Unit;

use Illuminate\View\View;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use App\Repositories\CommentRepo;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\CommentController;

class CommentControllerTest extends TestCase
{
    public function setUp(): void
    {
        $this->mockFactory = $this->createMock(Factory::class);
        app()->instance(Factory::class, $this->mockFactory);

        parent::setUp();
    }

    public function testGetCommentForResponse()
    {
        $this->mockFactory->expects($this->once())
            ->method('make')
            ->with('custom.partials.showParentComment')
            ->willReturn($this->createMock(View::class));

        $request = $this->createMock(Request::class);
        $request->expects($this->any())
            ->method('__get')
            ->with('commentId');
        app()->instance('request', $request);

        $commentRepo = $this->getMockBuilder(CommentRepo::class)
            ->onlyMethods(['getComment'])
            ->getMock();
        $commentRepo->expects($this->once())
            ->method('getComment');

        (new CommentController())->getCommentForResponse($commentRepo);
    }
}
