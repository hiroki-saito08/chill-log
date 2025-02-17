<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\FavoriteService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFavoriteRequest;

class FavoriteController extends Controller
{
    protected $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function toggle(StoreFavoriteRequest $request, Post $post)
    {
        return response()->json($this->favoriteService->toggleFavorite(Auth::id(), $post->id));
    }

    public function index()
    {
        return response()->json($this->favoriteService->getUserFavorites(Auth::id()));
    }
}
