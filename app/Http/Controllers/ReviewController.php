<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
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

        return redirect()->back();
    }

    public function update(UpdatereviewRequest $request, Review $review)
    {
        $image = null;

        if ($request->form['deleteImage']) {
            Image::where('post_id', $request->post_id)->delete();
        }
        if (isset($request->form['image'])) {
            $image = $request->form['image'];
        };

        $review->update([
            'star' => $request->form['star'],
            'comment_title' => $request->form['comment_title'],
            'comment_content' => $request->form['comment_content']
        ]);

        if (!is_null($image)) {
            $ImageController =  new ImageController();
            $ImageController->update($image, null, $review->id);
        }

        return redirect()->route('post.show', $review->post_id);
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
        return redirect()->back();
    }
}
