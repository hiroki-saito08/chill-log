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
   * 投稿を一覧取得
   */
  public function index()
  {
    return Inertia::render('ChillPages/Posts', [
      'posts' => $this->postService->getAllPosts()
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
