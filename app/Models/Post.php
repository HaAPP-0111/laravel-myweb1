<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts'; 

    // Đồng bộ chuẩn các cột trong database
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content', // Thay đổi tại đây
        'status',
        'user_id'
    ];
}