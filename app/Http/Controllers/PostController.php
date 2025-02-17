<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        return response()->json($this->postService->getAllPosts());
    }

    public function store(StorePostRequest $request)
    {
        return response()->json($this->postService->createPost($request->validated()), 201);
    }

    public function show(Post $post)
    {
        return response()->json($this->postService->getPostById($post->id));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        return response()->json($this->postService->updatePost($post, $request->validated()));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $this->postService->deletePost($post);

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
