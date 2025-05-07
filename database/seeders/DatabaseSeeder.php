<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Image;
use App\Models\Review;
use App\Models\Favorite;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('post_images');
        Storage::disk('public')->makeDirectory('profile_images');

        $postImages = ['sample1.jpg', 'sample2.jpg', 'sample3.jpg'];
        $profileImages = ['user1.jpg', 'user2.jpg', 'user3.jpg'];

        // ユーザー作成
        $users = User::factory(5)->create()->each(function ($user, $index) use ($profileImages, $postImages) {

            // プロフィール画像設定
            $profileImageName = 'profile_' . uniqid() . '.jpg';
            Storage::disk('public')->copy('profile_images/' . $profileImages[$index % count($profileImages)], 'profile_images/' . $profileImageName);
            $user->profile_image = 'profile_images/' . $profileImageName;
            $user->save();

            // 投稿作成（1投稿1画像）
            $posts = Post::factory(3)->create([
                'user_id' => $user->id
            ]);

            foreach ($posts as $post) {
                $imageName = 'post_' . uniqid() . '.jpg';
                $img = $postImages[array_rand($postImages)];
                Storage::disk('public')->copy("post_images/{$img}", "post_images/{$imageName}");

                Image::create([
                    'post_id' => $post->id,
                    'image_path' => "post_images/{$imageName}"
                ]);
            }
        });

        // レビューとお気に入りをランダムに付与
        $allPosts = Post::all();
        $allUsers = User::all();

        foreach ($allPosts as $post) {
            // 他のユーザー1人からレビュー
            $reviewer = $allUsers->where('id', '!=', $post->user_id)->random();
            Review::create([
                'user_id' => $reviewer->id,
                'post_id' => $post->id,
                'rating_overall' => rand(3, 5),
                'rating_relax' => rand(3, 5),
                'rating_safety' => rand(3, 5),
                'rating_silence' => rand(3, 5),
                'comment' => fake()->sentence()
            ]);

            // ランダムお気に入り登録（50%の確率）
            if (rand(0, 1)) {
                $favoriter = $allUsers->where('id', '!=', $post->user_id)->random();
                Favorite::firstOrCreate([
                    'user_id' => $favoriter->id,
                    'post_id' => $post->id,
                ]);
            }
        }
    }
}
