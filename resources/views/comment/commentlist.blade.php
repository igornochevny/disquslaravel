<div id="comment-list" class="comment-list">
    @foreach($post->comments as $comment)
        @include ('comment.comment')
    @endforeach
</div>