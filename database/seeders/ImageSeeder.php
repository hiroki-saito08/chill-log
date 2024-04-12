<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'name' => 'P1030094.JPG',
                'path' => '/storage/images/postImages/P1030269.JPG',
                'post_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'P1020947.JPG',
                'path' => '/storage/images/postImages/P1020981.JPG',
                'post_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '20170617_094344.jpg',
                'path' => '/storage/images/postImages/1711602685_P1020858.JPG',
                'post_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '20170610_190502.jpg',
                'path' => '/storage/images/postImages/20170617_112110.jpg',
                'post_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '20170604_122112.jpg',
                'path' => '/storage/images/postImages/20170604_122112.jpg',
                'post_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '20170602_145718-1.jpg',
                'path' => '/storage/images/postImages/P1030161.JPG',
                'post_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
