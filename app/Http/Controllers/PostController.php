<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

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
    $user = auth()->user();
    $post = $this->postService->getPostById($id);

    $post->is_favorited = $user
      ? $user->favorites->pluck('post_id')->contains($post->id)
      : false;

    return Inertia::render('ChillPages/PostDetail', [
      'post' => $post
    ]);
  }

  /**
   * 投稿を保存
   */
  public function store(PostRequest $request)
  {
    $post = $this->postService->createPost(Auth::user(), $request->validated());
    return redirect()->route('posts.show', ['post' => $post->id]);
  }

  public function destroy(Post $post)
  {
    $this->postService->deletePost($post);

    return back(303)->with('message', 'Removed post');
  }
}
