<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;

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
      'posts' => $this->postService->getNewPosts()
    ]);
  }

  /**
   * 投稿一覧ページ（Posts.vue）
   */
  public function posts(Request $request)
  {
    $posts = $this->postService->getFilteredPosts($request);

    return Inertia::render('ChillPages/Posts', [
      'posts' => $posts,
      'filters' => $request->only('keyword', 'category'),
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

  /**
   * 投稿を更新
   */
  public function update(PostRequest $request, Post $post)
  {
    $this->authorize('update', $post);
    $post = $this->postService->updatePost($post, $request->validated());

    return redirect()->route('posts.show', $post)->with('message', 'Post updated successfully.');
  }

  public function destroy(Post $post)
  {
    $this->postService->deletePost($post);

    return back(303)->with('message', 'Removed post');
  }
}
