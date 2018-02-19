<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public $filename;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get()->all();
        return view('blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request, Post $post)
    {
        $data = $request->all();
        $user = Auth::user();

        if($request->image !== null){
            $this->filename =  $request->image->hashName();
            $request->file('image')->store('img');
            $data['image'] =  $this->filename;
        }


        if($user) {
            $data['author'] = (!empty($data['author'])) ? $data['author'] : $user->name;
        }
        $post->create($data)->user()->associate($user)->save();

        Session::flash('flash_message', 'Post was added');

        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
//        dd($post->image);
        return view('blog.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('blog.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);
        $input = Input::all();
        if($post->where('user_id', $user->id) && $user){
            if(isset($input['image'])){
                $this->filename =  $request->image->hashName();
                $request->file('image')->store('img');
                $input['image'] =  $this->filename;
            }
            $input['author'] = (!empty($input['author'])) ? $input['author'] : $user->name;
            $post->update($input);
        }

        Session::flash('flash_message', 'Post was updated');
        return redirect()->route('blog.index');
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
        $post = Post::findOrFail($id);

        if($post->user_id == $user->id) {
            $post->comments()->delete();
            $post->delete();

            Session::flash('flash_message', 'Post was deleted');

            return redirect()->route('blog.index');

        } else {

                Session::flash('flash_message_post_error', 'You can not delete it');

                return back();
        }
    }

}
