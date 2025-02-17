<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Post;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(StoreReviewRequest $request, Post $post)
    {
        return response()->json($this->reviewService->createReview(Auth::id(), $post->id, $request->validated()), 201);
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        return response()->json($this->reviewService->updateReview($review, $request->validated()));
    }

    public function destroy($id)
    {
        $this->authorize('delete', $id);
        $this->reviewService->deleteReview($id);

        return response()->json(['message' => 'Review deleted']);
    }
}
