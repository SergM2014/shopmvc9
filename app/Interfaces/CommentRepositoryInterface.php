<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    public function getCommentTreeStructure(int $parentId, Collection $comments): string;
}