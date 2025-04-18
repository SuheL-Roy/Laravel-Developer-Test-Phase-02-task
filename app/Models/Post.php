<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'category',
        'slug',
        'content',
        'image',
        'user_id'
    ];
}
