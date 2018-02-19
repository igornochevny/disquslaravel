@extends('layouts.panel')
@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a href="{{ route('blog.index')  }}" class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2">
                <i aria-hidden="true" class="fa fa-backward"></i>
                back
            </a>
            <div class="text-center col-md-11 col-sm-10 col-xs-10">
                <b>New Post</b>
            </div>
        </div>
    </div>
    <div class="panel-body">
        {!! Form::open(['route' => 'blog.store', 'files' => true]) !!}
        @include('blog._form')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create</button>
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