<?php

namespace App\Http\Controllers\ChillControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorereviewRequest;
use App\Http\Requests\UpdatereviewRequest;
use App\Models\Review;
use Inertia\Inertia;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorereviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorereviewRequest $request)
    {
        $image = $request->file('image');

        $reviewData = Review::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'star' => $request->star,
            'comment_title' => $request->comment_title,
            'comment_content' => $request->comment_content
        ]);

        if (!is_null($image)) {
            // imageコントローラーで画像のインサートを行う
            $ImageController =  new ImageController();
            $ImageController->store($image, null, $reviewData->id);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatereviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatereviewRequest $request, Review $review)
    {
        // putをポストにするため、formの階層に配列で入れて送ってる
        $image = $request->form['image'];

        $review->update([
            'star' => $request->form['star'],
            'comment_title' => $request->form['comment_title'],
            'comment_content' => $request->form['comment_content']
        ]);

        if (!is_null($image)) {
            $ImageController =  new ImageController();
            $ImageController->update($image, null, $review->id);
        }

        return redirect()->back();
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
