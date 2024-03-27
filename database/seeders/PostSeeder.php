<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿1',
                'content' => 'ここはとっても安らげる空間です',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿2',
                'content' => 'ここは火山があってすごく貴重な体験ができる',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿3',
                'content' => 'ハワイ島というところです',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿4',
                'content' => '燃え盛ってました',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿5',
                'content' => 'お花がありました',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿6',
                'content' => '可愛いわんちゃん',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
