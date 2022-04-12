<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\CommentRepositoryInterface;

class CommentRepo implements CommentRepositoryInterface
{
    public function getCommentTreeStructure(?int $parentId, Collection $comments): string
    {
        return Comment::getCommentsTreeStructure($parentId, $comments);
    }

    public function create(Request $request): Comment
    {
        return  Comment::create(['product_id'=> $request->product_id, 'avatar'=>$request->avatar, 'name'=> $request->name,
            'parent_id'=>$request->parent_id, 'email'=>$request->email, 'comment'=>$request->comment, 'published'=>'0',
            'changed' =>'0']);
    }
}