<?php

namespace App\Http\Controllers\ChillControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ChillControllers\ImageController;
use App\Models\Image;
use App\Models\Review;
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
            'content' => $request->content,
            'location' => 'テスト県テスト市'
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
        $own_post = false;
        $post = post::where('id', $id)->with('images')->with('reviews')->with(['reviews.images'])->withCount('reviews')->with('rating')->first();
        $user = Auth::user();

        // 投稿がログインユーザーのものか判定->編集と削除のボタンを表示する
        if ($post->user_id == Auth::id()) {
            $own_post = true;
        }

        // ログインユーザーのコメントがあれば取得する
        $review = Review::where([
            ['post_id', $id],
            ['user_id', Auth::id()],
        ])->first();

        return Inertia::render('ChillPages/Post-detail', [
            'post' => $post,
            'user' => $user,
            'review' => $review,
            'own_post' => $own_post,
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
        $image = null;
        if (isset($request->form['image'])) {
            $image = $request->form['image'];
        };

        $post->update([
            'status' => $request->form['status'],
            'title' => $request->form['title'],
            'content' => $request->form['content'],
            'location' => 'テスト県テスト市'
        ]);

        if (!is_null($image)) {
            // imageコントローラーで画像のインサートを行う
            $ImageController =  new ImageController();
            $ImageController->update($image, $post->id, null);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
