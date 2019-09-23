@extends('layouts.app')

@section('content')
  <h1>Create Post</h1>
  <hr>
  {!! Form::open(['action' => 'PostsController@store', 'files' => true]) !!}
    <div class="form-group">
      {!! Form::label('title', 'Post Title') !!}
      {!! Form::text('title', '', ['class' => 'form-control']) !!}
    </div>
    
    <div class="form-group">
      {!! Form::label('body', 'Post Content') !!}
      {!! Form::textarea('body', '', ['class' => 'form-control', 'cols' => '30', 'rows' => '10']) !!}
    </div>

    <div class="form-group">
      <div>
        <small><strong>(File size no more than 2 MB)</strong></small>
      </div>
      {!! Form::file('image', ['accept' => 'image/*']) !!}
    </div>

    {!! Form::submit('Create Post', ['class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection