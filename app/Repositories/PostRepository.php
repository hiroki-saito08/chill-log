<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
  public function getPopularPosts()
  {
    return Post::withCount('reviews')
      ->orderByDesc('reviews_count')
      ->take(5)
      ->get();
  }

  public function getAllPosts()
  {
    return Post::where('status', 'public')
      ->with(['user', 'images', 'reviews'])
      ->latest()
      ->paginate(10);
  }

  public function getPostById($id)
  {
    return Post::where('id', $id)
      ->with(['user', 'images', 'reviews.user'])
      ->firstOrFail();
  }

  public function createPost(array $data)
  {
    return Post::create($data);
  }
}
