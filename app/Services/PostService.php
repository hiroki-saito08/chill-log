<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Models\Image;

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
}
