<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function addPostComment(Request $request, Post $post){

       $post->addComment($request->body);

        Session::flash('flash_message', 'Comment was added');

        return back();

    }

    public function addReplyComment(Request $request, Comment $comment){

        $user = Auth::user();

        if ($request->comment->user_id == $user->id)
        {
            Session::flash('flash_message_error', 'You can not reply to yourself');
            return back();
        }

        $comment->addComment($request->body);

        Session::flash('flash_message', 'Comment was added');

        return back();

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        $user = Auth::user();

            $comment = Comment::find($id);

            if($comment->user_id == $user->id){
                $comment->name = $user->name;
                $comment->body = Input::get('body');
                $comment->save();

                Session::flash('flash_message', 'Comment was updated');

                return back();

            } else {

                Session::flash('flash_message_error', 'You can not update it');

                return back();
            }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $comment = Comment::findOrFail($id);

        if($comment->user_id == $user->id){
            $comment->comments()->delete();
            $comment->delete();
            Session::flash('flash_message', 'Comment was deleted');
            return back();
        } else {

            Session::flash('flash_message_error', 'You can not delete it');

            return back();
        }

    }

}
