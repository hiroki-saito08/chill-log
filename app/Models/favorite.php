<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id'
    ];

    /**
     * user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
