<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'path'
    ];

    /**
     * post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * review
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
