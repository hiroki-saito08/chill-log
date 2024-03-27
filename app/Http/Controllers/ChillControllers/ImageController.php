<?php

namespace App\Http\Controllers\ChillControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreimageRequest;
use App\Http\Requests\UpdateimageRequest;
use App\Models\image;

class ImageController extends Controller
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
     * @param  \App\Http\Requests\StoreimageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($image, $postId)
    {
        // 画像を保存して、かつimageテーブルにインサートする
        // その後インサートした情報を返却する
        $time = strtotime(now());
        $filename = $time . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('public/images/postImages', $filename);

        $imageData = image::create([
            'name' => $filename,
            'path' => $path,
            'post_id' => $postId
        ]);

        return ($imageData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateimageRequest  $request
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateimageRequest $request, image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(image $image)
    {
        //
    }
}
