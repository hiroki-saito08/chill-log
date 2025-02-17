<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'rating_overall' => 'required|integer|min:1|max:5',
            'rating_silence' => 'required|integer|min:1|max:5',
            'rating_relax' => 'required|integer|min:1|max:5',
            'rating_safety' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $review = $post->reviews()->create([
            'user_id' => Auth::id(),
            'rating_overall' => $request->rating_overall,
            'rating_silence' => $request->rating_silence,
            'rating_relax' => $request->rating_relax,
            'rating_safety' => $request->rating_safety,
            'comment' => $request->comment
        ]);

        return response()->json($review, 201);
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete();

        return response()->json(['message' => 'Review deleted']);
    }
}
