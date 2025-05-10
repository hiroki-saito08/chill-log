<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // お気に入り登録したユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // お気に入り登録されたスポット
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
