<div class="panel-body">
<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>
                <h4>
                    {{$comment->name}}
                    <span style="float: right; display: inline-block">
                        <div class="form-group">
                            <a class="btn btn-primary btn-xs" data-toggle="modal" href="#{{$comment->id}}">edit</a>
                            <div class="modal fade" id="{{$comment->id}}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open(['route' => ['comment.update', $comment->id], 'method' => 'PUT']) !!}
                                            {{ csrf_field()}}
                                            <div class="form-group">
                                                {!!Form::label('body', 'Comment') !!}
                                                {!!Form::textarea('body', $comment->body, ['class' => 'form-control', 'required'])!!}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{Form::button('Save changes', ['class' => 'btn btn-primary', 'type' => 'submit'])}}
                                            {{Form::close()}}
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{Form::open(['class' => 'confirm-delete', 'route' => ['comment.destroy', $comment->id], 'method' => 'DELETE'])}}
                            {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs delete-button', 'type' => 'submit', 'id' => $comment->id])}}
                            {{Form::close()}}
                        </div>
                    </span>
                </h4>
            </b>
            <span class="text-muted">
                <h5>
                    Created at {{$comment->created_at}}
                </h5>
            </span>
        </div>
        <div class="panel-body">
            {{$comment->body}}
        </div>
        <div class="panel-footer">
            <button type="button" id="{{$comment->id}}" class="btn btn-info btn-xs reply">Reply</button>
        </div>
    </div>
    <div class="reply-form-{{$comment->id}}" style="display: none">
        {!! Form::open(['route' => ['replycomment.store', $comment->id], 'method' => 'POST']) !!}
        {{ csrf_field()}}
        <div class="form-group" >
            {!!Form::label('body', 'Reply') !!}
            {!!Form::textarea('body', null, ['class' => 'form-control', 'rows' => '2', 'required '])!!}
        </div>
        <div class="form-group">
            {{Form::button('Reply', ['class' => 'btn btn-primary', 'type' => 'submit'])}}
            {{Form::close()}}
        </div>
    </div>
    @if (isset($comment->comments))
        @include ('reply.replylist', ['comment' => $comment])
    @endif
</div>
</div>