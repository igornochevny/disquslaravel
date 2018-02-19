@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="text-center">
                    <h1><b>Blog</b></h1>
                </div>
                <div class="row">
                    <div class="panel-body">
                        <a class="btn btn-success" href="{{route('blog.create')}}" role="button">
                            Add new post
                        </a>
                    </div>
                </div>
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">{{Session::get('flash_message')}}</div>
                @endif
                @if(Session::has('flash_message_post_error'))
                    <div class="alert alert-danger">{{Session::get('flash_message_post_error')}}</div>
                @endif
                @foreach ($posts as $post)
                    <div class="row">
                        <div class="panel panel-default col-md-8">
                            <div class="panel-body">
                                <div class="card" style="width: 20rem">
                                    <img class="card-img-top" src="img/{{$post->image}}" alt="Card image cap" width="590px" height="590px">
                                    <div class="card-block">
                                        <h3 class="card-title"><b>{{$post->title}}</b></h3>
                                        <h5 class="card-text">{{\Illuminate\Support\Str::limit($post->content, 90)}}</h5>
                                        <p class="card-text"><b>Author: </b>{{$post->author}}</p>
                                        <p class="card-text"><b>{{$post->created_at->format('d M Y, G:i')}}</b></p>
                                    </div>
                                </div>
                                {{ link_to_route('blog.show', 'Read more', [$post->id], ['class' => 'btn btn-primary']) }}
                                <span style="float: right">
                                    {{Form::open(['class' => 'confirm-delete', 'route' => ['blog.destroy', $post->id], 'method' => 'DELETE'])}}
                                    {{ link_to_route('blog.edit', 'edit', [$post->id], ['class' => 'btn btn-success btn-xs']) }}
                                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                                    {{Form::close()}}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection