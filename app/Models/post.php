<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'title',
        'content',
        'location'
    ];

    /**
     * images
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * favorites
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ratings
     */
    public function rating()
    {
        return $this->reviews()->selectRaw('post_id, ROUND(avg(star), 2) AS avg_review')->groupBy('post_id');
    }
}
