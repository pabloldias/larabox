<?php

namespace App\Repositories;

use App\Post;

class PostRepository 
{
    public function all()
    {
        return Post::latest()
            ->filter(request(['year', 'month']))
            ->get();
    }
}