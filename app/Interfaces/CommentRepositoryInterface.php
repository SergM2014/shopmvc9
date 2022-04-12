<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    public function getCommentTreeStructure(int $parentId, Collection $comments): string;

    public function create(Request $request): Comment;

    public function getComment(int $id): Comment;
}