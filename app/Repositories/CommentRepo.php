<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Comment;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\CommentRepositoryInterface;

class CommentRepo implements CommentRepositoryInterface
{
    public function getCommentTreeStructure(?int $parentId, Collection $comments): string
    {
        return Comment::getCommentsTreeStructure($parentId, $comments);
    }
}