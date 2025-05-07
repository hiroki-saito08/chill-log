<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
  public function storeImage(UploadedFile $image, $postId)
  {
    $path = $image->store('uploads', 'public');
    return Image::create([
      'post_id' => $postId,
      'image_path' => $path,
    ]);
  }
}
