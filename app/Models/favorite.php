<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'star',
        'comment_title',
        'comment_content',
        'image_id'
    ];
}
