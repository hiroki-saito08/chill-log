<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::with('images')->get());
    }

    public function store(StorePostRequest $request)
    {
        $post = Auth::user()->posts()->create($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');
                $post->images()->create(['image_path' => $path]);
            }
        }

        return response()->json($post->load('images'), 201);
    }

    public function show(Post $post)
    {
        return response()->json($post->load(['images', 'reviews']));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        foreach ($post->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
