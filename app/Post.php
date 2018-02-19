<?php

namespace App;

use App\Traits\CommentTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use CommentTrait;

    protected $fillable = ['title', 'content', 'author', 'image', 'user_id', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
