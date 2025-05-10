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
        'title',
        'category',
        'location_name',
        'latitude',
        'longitude',
        'description',
        'visit_time',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // 投稿者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 画像
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // レビュー
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // お気に入り
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // ランキング
    public function rankings()
    {
        return $this->hasMany(Ranking::class);
    }
}
