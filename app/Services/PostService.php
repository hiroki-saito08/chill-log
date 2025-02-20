<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService
{
  public function getAllPosts()
  {
    return Post::with('images')->get();
  }

  public function getPostById($id)
  {
    return Post::with(['images', 'reviews'])->findOrFail($id);
  }

  public function createPost(array $data)
  {
    $post = Auth::user()->posts()->create($data);

    if (isset($data['images'])) {
      foreach ($data['images'] as $image) {
        $path = $image->store('posts', 'public');
        $post->images()->create(['image_path' => $path]);
      }
    }

    return $post->load('images');
  }

  public function updatePost(Post $post, array $data)
  {
    $post->update($data);

    // 画像が送信された場合のみ更新
    if (isset($data['images'])) {
      foreach ($post->images as $image) {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
      }

      foreach ($data['images'] as $image) {
        $path = $image->store('posts', 'public');
        $post->images()->create(['image_path' => $path]);
      }
    }

    return $post->load('images');
  }

  public function deletePost(Post $post)
  {
    foreach ($post->images as $image) {
      Storage::disk('public')->delete($image->image_path);
      $image->delete();
    }

    $post->delete();
  }
}
