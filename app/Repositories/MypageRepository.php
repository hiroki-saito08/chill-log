<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Favorite;

class MypageRepository
{
  public function getUserPosts($userId)
  {
    return Post::where('user_id', $userId)
      ->with(['images', 'reviews'])
      ->latest()
      ->paginate(6);
  }

  public function getUserFavorites($userId)
  {
    return Favorite::where('user_id', $userId)
      ->with('post.images')
      ->paginate(6);
  }
}
