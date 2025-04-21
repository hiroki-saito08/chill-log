<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Review;

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
    $post = Post::where('id', $id)
      ->with(['user', 'images', 'reviews.user'])
      ->firstOrFail();

    $user = auth()->user();
    $myReview = $user
      ? Review::where('post_id', $id)->where('user_id', $user->id)->first()
      : null;

    $post->my_review = $myReview;

    return $post;
  }

  public function createPost(array $data)
  {
    return Post::create($data);
  }
}
