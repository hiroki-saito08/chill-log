<?php

namespace App\Http\Controllers\ChillControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreimageRequest;
use App\Http\Requests\UpdateimageRequest;
use App\Models\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

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
    public function store($image, $postId = null, $reviewId = null)
    {
        $manager = new ImageManager(new Driver());

        // 画像を保存して、かつimageテーブルにインサートする
        // その後インサートした情報を返却する
        $time = strtotime(now());
        $filename = $time . '_' . $image->getClientOriginalName();
        $directory = 'storage/images/postImages/';
        $path = $directory . $filename;
        $image = $manager->read($image);
        $image->scale(width: 1000);
        $image->toPng()->save($path);

        $imageData = Image::create([
            'name' => $filename,
            'path' => '/' . $path,
            'post_id' => $postId,
            'review_id' => $reviewId
        ]);

        return ($imageData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
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
    public function update($image, $postId = null, $reviewId = null)
    {
        $manager = new ImageManager(new Driver());

        // 画像を保存して、かつimageテーブルにインサートする
        // その後インサートした情報を返却する
        $time = strtotime(now());
        $filename = $time . '_' . $image->getClientOriginalName();
        $directory = 'storage/images/postImages/';
        $path = $directory . $filename;
        $image = $manager->read($image);
        $image->scale(width: 1000);
        $image->toPng()->save($path);

        if (!empty($postId)) {
            $image_record = Image::where('post_id', $postId)->first();
        } else {
            $image_record = Image::where('review_id', $reviewId)->first();
        }

        if (!empty($image_record)) {
            $imageData = $image_record->update([
                'name' => $filename,
                'path' => $path
            ]);
        } else {
            $imageData = Image::create([
                'name' => $filename,
                'path' => '/' . $path,
                'post_id' => $postId,
                'review_id' => $reviewId
            ]);
        }

        return ($imageData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
