<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'body',
        'likes_count',

    ];
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function PostImages(){
        return $this->hasMany(PostImage::class);
    }
}
