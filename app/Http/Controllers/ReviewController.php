<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Helpers\NgWordFilter;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
        // NGワードチェック
        if (filled($request->input('comment')) && NgWordFilter::containsNgWord($request->input('comment'))) {
            return back()->withErrors(['comment' => 'Contains inappropriate language.']);
        }

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        // 平均を計算して rating_overall に追加
        $validated['rating_overall'] = round((
            $validated['rating_relax'] +
            $validated['rating_safety'] +
            $validated['rating_silence']
        ) / 3, 1);

        Review::create($validated);

        return redirect()->back()->with('message', 'Review stored successfully!');
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        // NGワードチェック
        if (filled($request->input('comment')) && NgWordFilter::containsNgWord($request->input('comment'))) {
            return back()->withErrors(['comment' => 'Contains inappropriate language.']);
        }

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
