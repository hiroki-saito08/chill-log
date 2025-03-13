<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
  public function getAllPosts()
  {
    return Post::where('status', 'public')
      ->with(['user', 'images', 'reviews'])
      ->orderBy('created_at', 'DESC')
      ->paginate(10);
  }

  public function createPost(array $data)
  {
    return Post::create($data);
  }
}
