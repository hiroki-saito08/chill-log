<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Post $post)
    {
        $favorite = Auth::user()->favorites()->where('post_id', $post->id)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Removed from favorites']);
        } else {
            Auth::user()->favorites()->create(['post_id' => $post->id]);
            return response()->json(['message' => 'Added to favorites']);
        }
    }

    public function index()
    {
        return response()->json(Auth::user()->favorites()->with('post')->get());
    }
}
