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
                'location' => '35.719609408481,139.59007646484',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿2',
                'content' => 'ここは火山があってすごく貴重な体験ができる',
                'location' => '35.719609408481,139.59007646484',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿3',
                'content' => '面白いところ',
                'location' => '35.719609408481,139.59007646484',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿4',
                'content' => 'ハワイの綺麗なところ',
                'location' => '35.719609408481,139.59007646484',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿5',
                'content' => 'お花がありました',
                'location' => '35.719609408481,139.59007646484',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'status' => 1,
                'title' => 'テスト投稿6',
                'content' => '綺麗な景色',
                'location' => '35.719609408481,139.59007646484',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
