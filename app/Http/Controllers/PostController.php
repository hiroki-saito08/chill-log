<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  protected $postService;

  public function __construct(PostService $postService)
  {
    $this->postService = $postService;
  }

  /**
   * トップページ（Index.vue）
   */
  public function index()
  {
    return Inertia::render('ChillPages/Index', [
      'popularPosts' => $this->postService->getPopularPosts(),
      'posts' => $this->postService->getAllPosts()
    ]);
  }

  /**
   * 投稿一覧ページ（Posts.vue）
   */
  public function posts()
  {
    return Inertia::render('ChillPages/Posts', [
      'posts' => $this->postService->getAllPosts()
    ]);
  }

  /**
   * 投稿詳細ページ（PostDetail.vue）
   */
  public function show($id)
  {
    return Inertia::render('ChillPages/PostDetail', [
      'post' => $this->postService->getPostById($id)
    ]);
  }

  /**
   * 投稿を保存
   */
  public function store(PostRequest $request)
  {
    $this->postService->createPost(Auth::user(), $request->validated());
    return redirect()->route('posts');
  }
}
