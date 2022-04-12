<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Http\JsonResponse;
use App\Repositories\CommentRepo;

class CommentController extends Controller
{
    public function add(CommentRepo $commentRepo, Request $request): JsonResponse
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email',
            'comment'=>'required',
            'captcha' => 'required|captcha'
            ],
            ['captcha' => trans('messages.captcha')]
        );

        $commentRepo->create($request);

        return response()->json(['message' => trans('messages.commentAddedSuccessfuly'), 'success' => 'true']);
    }

    public function getCommentForResponse(): View
    {
        $commentId = \request('commentId');
        $comment= Comment::find($commentId);
        return view('custom.partials.showParentComment', compact('comment'));
    }
}
