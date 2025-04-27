<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
  protected $postRepository;

  public function __construct(PostRepository $postRepository)
  {
    $this->postRepository = $postRepository;
  }

  public function getPopularPosts()
  {
    return $this->postRepository->getPopularPosts();
  }

  public function getNewPosts()
  {
    return $this->postRepository->getNewPosts();
  }

  public function getAllPosts()
  {
    return $this->postRepository->getAllPosts();
  }

  public function getPostById($id)
  {
    return $this->postRepository->getPostById($id);
  }

  public function createPost($user, array $data)
  {
    $data['user_id'] = $user->id;

    // 投稿を保存
    $post = $this->postRepository->createPost($data);

    // 画像保存処理
    if (!empty($data['images'])) {
      foreach ($data['images'] as $imageFile) {
        $path = $imageFile->store('post_images', 'public');

        Image::create([
          'post_id' => $post->id,
          'image_path' => $path,
        ]);
      }
    }

    return $post;
  }

  public function updatePost(Post $post, array $data)
  {
    // 投稿を保存
    $post->update([
      'title' => $data['title'],
      'category' => $data['category'],
      'location_name' => $data['location_name'],
      'latitude' => $data['latitude'],
      'longitude' => $data['longitude'],
      'description' => $data['description'],
      'visit_time' => $data['visit_time'],
      'status' => $data['status']
    ]);

    // 画像がアップロードされている場合
    if (!empty($data['images'])) {
      // 既存の画像ファイルがあれば削除
      if ($post->images && $post->images->count()) {
        foreach ($post->images as $originalImage) {
          Storage::disk('public')->delete($originalImage->image_path);
          $originalImage->delete(); // インスタンスメソッド
        }
      }

      foreach ($data['images'] as $imageFile) {
        // 新しい画像を保存
        $path = $imageFile->store('post_images', 'public');

        Image::create([
          'post_id' => $post->id,
          'image_path' => $path,
        ]);
      }
    }

    return $post;
  }

  public function deletePost(Post $post)
  {
    // 紐づく画像を全削除
    foreach ($post->images as $image) {
      Storage::disk('public')->delete($image->image_path);
      $image->delete();
    }

    $post->delete();
  }
}
