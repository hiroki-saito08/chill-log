<?php

namespace App\Services;

use App\Models\Favorite;

class FavoriteService
{
  public function toggleFavorite($userId, $postId)
  {
    $favorite = Favorite::where('user_id', $userId)->where('post_id', $postId)->first();

    if ($favorite) {
      $favorite->delete();
      return ['message' => 'Removed from favorites'];
    } else {
      Favorite::create(['user_id' => $userId, 'post_id' => $postId]);
      return ['message' => 'Added to favorites'];
    }
  }

  public function getUserFavorites($userId)
  {
    return Favorite::where('user_id', $userId)->with('post')->get();
  }
}
