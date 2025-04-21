<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Post;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    public function store(Post $post)
    {
        $user = auth()->user();
        $user->favorites()->firstOrCreate(['post_id' => $post->id]);

        return back(303)->with('message', 'Added to favorites!');
    }

    public function destroy(Post $post)
    {
        $user = auth()->user();
        $user->favorites()->where('post_id', $post->id)->delete();

        return back(303)->with('message', 'Removed from favorites.');
    }
}
