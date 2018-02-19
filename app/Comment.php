<?php

namespace App;

use App\Traits\CommentTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    use CommentTrait;

    protected $fillable = ['name', 'body', 'user_id'];

    /**
     * Получить все модели, обладающие commentable.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
