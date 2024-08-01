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
use App\Models\Favorite;
use App\Models\Image;
use App\Models\Review;
use App\Models\User;
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
        // ページネーション
        $posts = Post::where('status', 1)->with('user')->with('images')->with('reviews')->with(['reviews.images'])->withCount('reviews')->with('rating')->orderBy('posts.created_at', 'DESC')->paginate(6);

        return Inertia::render('ChillPages/Posts', [
            'posts' => $posts
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchWord = $request->searchWord;
        if (empty($searchWord)) {
            $searchWord  = session()->get('searchWord');
        }

        // セッションに保存する
        session()->put('searchWord', $searchWord);

        $posts = Post::where('status', 1)
            ->where('title', 'LIKE', "%{$searchWord}%")
            ->orWhere('content', 'LIKE', "%{$searchWord}%")
            ->with('user')->with('images')->with('reviews')
            ->with(['reviews.images'])->withCount('reviews')
            ->with('rating')
            ->orderBy('posts.created_at', 'DESC')->paginate(6);

        return Inertia::render('ChillPages/Posts', [
            'posts' => $posts,
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
        $location = '';

        if (!empty($request->location['lat']) && !empty($request->location['lng'])) {
            $location_lat = $request->location['lat'];
            $location_lng = $request->location['lng'];
            $location =  $location_lat . ',' . $location_lng;
        }

        $postData = Post::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'title' => $request->title,
            'content' => $request->content,
            'location' => $location
        ]);

        if (!is_null($image)) {
            // imageコントローラーで画像のインサートを行う
            $ImageController =  new ImageController();
            $ImageController->store($image, $postData->id, null);
        }

        return redirect()->route('post.show', $postData->id);
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
        $isFavorite = false;
        $favoriteId = null;

        // レビューを新基順にソート（最後にソートするとうまく行った）
        $post = Post::where('id', $id)->with('user')->with('images')
            ->with(['reviews.user', 'reviews.images'])->withCount('reviews')->with('rating')
            ->with(array('reviews' => function ($query) {
                $query->orderBy('created_at', 'DESC');
            }))->first();

        $user = Auth::user();
        if (!empty($user)) {
            $favorite = Favorite::where('user_id', $user->id)->where('post_id', $post->id)->first();

            if (!empty($favorite)) {
                $isFavorite = true;
                $favoriteId = $favorite->id;
            }
        }

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
            'isFavorite' => $isFavorite,
            'favoriteId' => $favoriteId
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
        $location = '';

        if ($request->form['deleteImage']) {
            Image::where('post_id', $post->id)->delete();
        }
        if (isset($request->form['image'])) {
            $image = $request->form['image'];
        };

        if (!empty($request->form['location']['lat']) && !empty($request->form['location']['lng'])) {
            $location_lat = $request->form['location']['lat'];
            $location_lng = $request->form['location']['lng'];
            $location =  $location_lat . ',' . $location_lng;
        }

        $post->update([
            'status' => $request->form['status'],
            'title' => $request->form['title'],
            'content' => $request->form['content'],
            'location' => $location
        ]);

        if (!is_null($image)) {
            // imageコントローラーで画像のインサートを行う
            $ImageController =  new ImageController();
            $ImageController->update($image, $post->id, null);
        }

        return redirect()->back();
    }

    public function own()
    {
        $user = Auth::user();
        $posts = Post::where('status', 1)->where('user_id', $user->id)
            ->with('user')->with('images')->with('reviews')->with(['reviews.images'])
            ->withCount('reviews')->with('rating')
            ->orderBy('posts.created_at', 'DESC')->paginate(6);

        return Inertia::render('ChillPages/Profile/Own-posts', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function favorite(Request $request)
    {
        $user = Auth::user();
        // Eloquentでの取得が難しいため、IN句で取得する
        $favoritePostIds = Favorite::where('user_id', $user->id)->pluck("post_id")->toArray();

        $posts = Post::whereIn('id', $favoritePostIds)
            ->with('user')->with('images')->with('reviews')->with(['reviews.images'])
            ->withCount('reviews')->with('rating')
            ->orderBy('posts.created_at', 'DESC')->paginate(6);

        return Inertia::render('ChillPages/Profile/Favorite-posts', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function save(StorepostRequest $request)
    {
        $image = $request->file('image');
        $location = '';

        if (!empty($request->location['lat']) && !empty($request->location['lng'])) {
            $location_lat = $request->location['lat'];
            $location_lng = $request->location['lng'];
            $location =  $location_lat . ',' . $location_lng;
        }

        $postData = Post::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'title' => $request->title,
            'content' => $request->content,
            'location' => $location
        ]);

        if (!is_null($image)) {
            // imageコントローラーで画像のインサートを行う
            $ImageController =  new ImageController();
            $ImageController->store($image, $postData->id, null);
        }

        return redirect()->route('post.show', $postData->id);
    }

    public function savePosts()
    {
        $user = Auth::user();
        $posts = Post::where('status', 0)->where('user_id', $user->id)
            ->with('user')->with('images')->with('reviews')->with(['reviews.images'])
            ->withCount('reviews')->with('rating')
            ->orderBy('posts.created_at', 'DESC')->paginate(6);

        return Inertia::render('ChillPages/Profile/Save-posts', [
            'user' => $user,
            'posts' => $posts
        ]);
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
