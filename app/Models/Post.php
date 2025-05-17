<?php

namespace App\Models;

use LaraZeus\Mark\Traits\Like\Likeable;

class Post extends \LaraZeus\Sky\Models\Post
{
    use Likeable;

    public function love(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        $hasLike = $user->hasLiked($this);

        if ($hasLike) {
            $user->unmarkLike($this);
        } else {
            $user->like($this);
        }

        return $hasLike;
    }
}
