<div class="panel panel-default">
    <div class="panel-heading">
        <b>
            <h4>
                {{$reply->name}}
                <span style="float: right">
                <button type="button" id="{{$reply->id}}" class="btn btn-primary btn-xs edit">Edit</button>
                    {{Form::open(['class' => 'confirm-delete', 'route' => ['comment.destroy', $reply->id], 'method' => 'DELETE'])}}
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs delete-button', 'type' => 'submit', 'id' => $reply->id])}}
                    {{Form::close()}}
            </span>
            </h4>
        </b>
        <span class="text-muted">
            <h5>
                Replied at {{$reply->created_at}} to {{$comment->name}}
            </h5>
        </span>
    </div>
    <div class="panel-body">
        {{$reply->body}}
    </div>
    <div class="panel-footer">
        <button type="button" id="{{$reply->id}}" class="btn btn-info btn-xs reply">Reply</button>
    </div>
</div>
<div class="edit-reply-form-{{$reply->id}}" style="display: none">
    {!! Form::open(['route' => ['comment.update', $reply->id], 'method' => 'PUT']) !!}
    {{ csrf_field()}}
    <div class="form-group" >
        {!!Form::label('body', 'Edit reply') !!}
        {!!Form::textarea('body', null, ['class' => 'form-control', 'rows' => '2', 'required '])!!}
    </div>
    <div class="form-group">
        {{Form::button('Edit', ['class' => 'btn btn-primary', 'type' => 'submit'])}}
        {{Form::close()}}
    </div>
</div>
<div class="reply-form-{{$reply->id}}" style="display: none">
    {!! Form::open(['route' => ['replycomment.store', $reply->id], 'method' => 'POST']) !!}
    {{ csrf_field()}}
    <div class="form-group" >
        {!!Form::label('body', 'Reply') !!}
        {!!Form::textarea('body', null, ['class' => 'form-control', 'rows' => '2', 'required'])!!}
    </div>
    <div class="form-group">
        {{Form::button('Reply', ['class' => 'btn btn-primary', 'type' => 'submit'])}}
        {{Form::close()}}
    </div>
</div>
@if (isset($comment->comments))
    @include ('reply.replylist', ['comment' => $reply])
@endif
