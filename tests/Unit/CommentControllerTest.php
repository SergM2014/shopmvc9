<?php

namespace Tests\Unit;

use Illuminate\View\View;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use App\Repositories\CommentRepo;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\CommentController;
use Illuminate\Contracts\Translation\Translator;

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

    public function testAdd()
    {
        $this->mockFactory->expects($this->once())
            ->method('make')
           // ->with('custom.partials.showParentComment')
            ->willReturn($this->createMock(JsonResponse::class));

        $commentRepo = $this->getMockBuilder(CommentRepo::class)
            ->onlyMethods(['create'])
            ->getMock();
        $commentRepo->expects($this->once())
            ->method('create');

        $request = $this->createMock(Request::class);

        $translator = $this->createMock(Translator::class);
//        $translator->expects($this->any())
//            ->method('__get')
//            ->with('messages.captcha')
//        ->willReturn($this->createMock(App()));
        app()->instance('trans', $translator);

        (new CommentController())->add($commentRepo, $request);
    }


}
