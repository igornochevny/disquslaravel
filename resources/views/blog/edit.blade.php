@extends('layouts.panel')
<?php  /** @var \Illuminate\Support\ViewErrorBag $errors */  ?>
@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a href="{{ route('blog.index')  }}" class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2">
                <i aria-hidden="true" class="fa fa-backward"></i>
                back
            </a>
            <div class="text-center col-md-9 col-sm-7 col-xs-6">Edit post: <b>{{$post->title}}</b></div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                    {{Form::open(['class' => 'confirm-delete', 'route' => ['blog.destroy', $post->id], 'method' => 'DELETE'])}}
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        {!! Form::model($post, ['route' => ['blog.update', $post->id], 'files' => true, 'method' => 'PUT']) !!}
        @include('blog._form')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@stop