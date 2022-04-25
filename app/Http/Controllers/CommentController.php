<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Repositories\CommentRepo;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function add(CommentRepo $commentRepo, StoreCommentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $commentRepo->create($validated);

        return response()->json(['message' => trans('messages.commentAddedSuccessfuly'), 'success' => 'true']);
    }

    public function getCommentForResponse(CommentRepo $commentRepo): View
    {
        $commentId = (int) \request('commentId');
        $comment = $commentRepo->getComment($commentId);

        return view('custom.partials.showParentComment', compact('comment'));
    }
}
