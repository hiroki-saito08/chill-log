<?php

namespace App\Services;

use App\Repositories\PostRepository;

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
    return $this->postRepository->createPost($user, $data);
  }
}
