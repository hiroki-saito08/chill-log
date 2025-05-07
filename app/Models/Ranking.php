<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'rank_type',
        'position',
        'ranking_date',
    ];

    // ランキング対象のスポット
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
