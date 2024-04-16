<?php

namespace App\Http\Controllers\ChillControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ChillControllers\ImageController;
use App\Models\Image;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::with('images')->with('reviews')->with(['reviews.images'])->withCount('reviews')->with('rating')->get();

        return Inertia::render('ChillPages/Posts', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepostRequest $request)
    {
        $image = $request->file('image');

        $postData = Post::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'title' => $request->title,
            'content' => $request->content
        ]);

        if (!is_null($image)) {
            // imageコントローラーで画像のインサートを行う
            $ImageController =  new ImageController();
            $ImageController->store($image, $postData->id, null);
        }
        // 追々投稿後は投稿したpostのshow画面に飛ばすように修正する
        return Redirect::to('/profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $post = post::where('id', $id)->with('images')->with('reviews')->with(['reviews.images'])->withCount('reviews')->with('rating')->first();
        $user = Auth::user();

        return Inertia::render('ChillPages/Post-detail', [
            'post' => $post,
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
