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
      ->get();
  }

  public function getUserFavorites($userId)
  {
    return Favorite::where('user_id', $userId)
      ->with('post')
      ->get();
  }
}
