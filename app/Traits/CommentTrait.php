<?php


namespace App\Traits;

use App\Comment;

trait CommentTrait
{

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function addComment($body){

        $comment = new Comment();
        $comment->body = $body;
        $comment->user_id = auth()->user()->id;
        $comment->name = auth()->user()->name;

        $this->comments()->save($comment);

        return $comment;
    }

}