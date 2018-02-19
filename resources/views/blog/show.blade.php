@extends('layouts.panel')
<?php
/** @var \App\Post $post */
?>
@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('blog.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="text-center col-md-9 col-sm-7 col-xs-6">Post: <b>{{$post->title}}</b></div>
            <span style="float: right">
                {{Form::open(['class' => 'confirm-delete', 'route' => ['blog.destroy', $post->id], 'method' => 'DELETE'])}}
                {{ link_to_route('blog.edit', 'edit', [$post->id], ['class' => 'btn btn-success btn-xs']) }}
                {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                {{Form::close()}}
            </span>
        </div>
    </div>
    <div class="panel-body">
        <div class="card" style="width: 20rem">
            <div class="panel-body">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="{{asset("img/" . $post->image)}}" alt="Card image cap" width="890px" height="590px">
                </div>
            </div>
        </div>
        <div class="jumbotron">
            <h2 class="display-3">{{$post->title}}</h2>
            <p class="lead">{{$post->content}}</p>
            <hr class="my-4">
            <h4>Author: </b>{{$post->author}}<span class="card-text" style="float: right"><b>{{$post->created_at->format('d M Y, G:i')}}</b></span></h4>
        </div>
        @if(Session::has('flash_message'))
            <div class="alert alert-success">{{Session::get('flash_message')}}</div>
        @endif
        @if(Session::has('flash_message_error'))
            <div class="alert alert-danger">{{Session::get('flash_message_error')}}</div>
        @endif
        <div class="container">
            <div class="row">
                @include ('comment.commentlist', ['post' => $post])
            </div>
        </div>
        <h2>Create new comment</h2>
        {!! Form::open(['route' => ['postcomment.store', $post->id], 'method' => 'POST']) !!}
        {{ csrf_field()}}
        @include('comment._form')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
@endsection
