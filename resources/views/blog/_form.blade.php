<div class="form-group" >
    {!!Form::label('image', 'Image') !!}
    {!!Form::file('image')!!}
</div>
<div class="form-group">
    {!!Form::label('title', 'Title') !!}
    {!!Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('content', 'Content') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('author', 'Author') !!}
    {!! Form::text('author', null, ['class' => 'form-control']) !!}
</div>
