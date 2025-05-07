<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\image>
 */
class ImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(), // 紐づけ
            'image_path' => 'post_images/sample.jpg', // ダミー画像名
        ];
    }
}
