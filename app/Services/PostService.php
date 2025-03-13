<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
  public function getAllPosts()
  {
    return Post::where('status', 'public')
      ->with(['user', 'images', 'reviews'])
      ->latest()
      ->paginate(10);
  }

  public function createPost($user, $validatedData)
  {
    $post = $user->posts()->create($validatedData);

    if (isset($validatedData['image'])) {
      $post->images()->create([
        'image_path' => $validatedData['image']->store('uploads', 'public')
      ]);
    }

    return $post;
  }
}
