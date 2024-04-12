<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'star',
        'comment_title',
        'comment_content',
    ];

    /**
     * images
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
