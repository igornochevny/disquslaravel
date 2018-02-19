@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12" >
                @if(Session::has('flash_message_post_error'))
                    <div class="alert alert-danger">{{Session::get('flash_message_post_error')}}</div>
                @endif
                <div class="panel panel-default">
                    @yield('panel')
                </div>
            </div>
        </div>
    </div>
@stop
