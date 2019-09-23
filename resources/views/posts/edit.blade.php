@extends('layouts.app')

@section('content')
  <h1>Edit Post</h1>
  <hr>
  {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
    <div class="form-group">
      {!! Form::label('title', 'Post Title') !!}
      {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
    </div>
    
    <div class="form-group">
      {!! Form::label('body', 'Post Content') !!}
      {!! Form::textarea('body', $post->body, ['class' => 'form-control', 'cols' => '30', 'rows' => '10']) !!}
    </div>

    <div class="form-group">
      <div>
        <small><strong>(File size no more than 2 MB)</strong></small>
      </div>
      {!! Form::file('image', ['accept' => 'image/*']) !!}
    </div>

    {!! Form::submit('Update Post', ['class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection