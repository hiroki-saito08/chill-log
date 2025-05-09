<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Inertia\Inertia;
use App\Models\Image;
use App\Http\Controllers\ChillControllers\ImageController;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        Review::create($validated);

        return redirect()->back()->with('message', 'Review stored successfully!');
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $this->authorize('update', $review);

        $review->update($request->validated());
        return redirect()->back()->with('message', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->back()->with('message', 'Review destroyed successfully!');
    }
}
