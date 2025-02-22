<?php

namespace App\Http\Controllers\ChillControllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('status', 1)->with('user')->with('images')->with('reviews')->withCount('reviews')->with('rating')->orderBy('posts.created_at', 'DESC')->limit(5)->get();

        // レビューの高い順かつレビューの数が多い順に並び替え（全体のクエリの並び替えはjoin必須）
        $popularPosts = Post::with('images')
            ->leftJoin('reviews', 'posts.id', '=', 'reviews.post_id')
            ->select('posts.id', 'posts.title', DB::raw('count(reviews.id) as reviews_count'))
            ->selectRaw('reviews.post_id, ROUND(avg(reviews.star), 2) AS avg_review')
            ->groupBy('posts.id', 'posts.title', 'reviews.post_id')
            ->orderBy('avg_review', 'DESC')
            ->orderBy('reviews_count', 'DESC')
            ->limit(3)
            ->get();

        return Inertia::render('ChillPages/Index', [
            'posts' => $posts,
            'popularPosts' => $popularPosts
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
