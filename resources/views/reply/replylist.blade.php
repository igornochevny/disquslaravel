<div id="reply-list" class="reply-list">
    @foreach($comment->comments as $reply)
        <div class="text-info" style="margin-left: 80px">
            @include ('reply.reply')
        </div>
    @endforeach
</div>