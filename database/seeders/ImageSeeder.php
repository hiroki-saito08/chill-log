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
                'path' => 'public/images/postImages/bIkNV57MuAScK2Xnsl7nHAnA3...',
                'post_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'P1020947.JPG',
                'path' => 'public/images/postImages/JDON4lUNlRc9sxaFMM8N81CLwfCRG6x4UFhxZ9ld.jpg',
                'post_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '20170617_094344.jpg',
                'path' => 'public/storage/images/postImages/61l1fvaebQsfvGeI8lKr9QnQ90LDOdUtraKUKrVx.jpg',
                'post_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '20170610_190502.jpg',
                'path' => 'public/storage/images/postImages/R1glfqNoB9EZnzwPfa9Jw5PhADRk8Jk20iwaugyj.jpg',
                'post_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '20170604_122112.jpg',
                'path' => 'public/storage/images/postImages/PXgYU7J6JjZ3VuH0j49tbYrcPh8Pxs7FlU2pLD6w.jpg',
                'post_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '20170602_145718-1.jpg',
                'path' => 'public/storage/images/postImages/EmYEtN910tl7KRxCMBxDq2KzrHaeeXXoSysFKLf3.jpg',
                'post_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
