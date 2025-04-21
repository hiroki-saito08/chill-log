<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating_overall',
        'rating_silence',
        'rating_safety',
        'rating_relax',
        'comment',
    ];

    // レビュー投稿者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // レビュー対象のスポット
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
