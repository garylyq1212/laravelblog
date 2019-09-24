@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-dark mb-4">Go To Blog Posts</a>
  <h1>{{ $post->title }}</h1>
  <small>Written by <strong>{{ $post->user->name }}</strong> on {{ $post->created_at }}</small>
  <hr>
  <p>{{ $post->body }}</p>
  @if ($post->image)
    <img       
      src="{{ Storage::disk('s3')->url($post->image) }}" 
      alt="post image" 
      width="300px" 
      height="300px"
    >  
  @endif
  <br>
  <br>

  @auth  
    @if ($post->user_id === Auth::user()->id)  
      <a href="/posts/{{ $post->id }}/edit" class="btn btn-info">Edit Post</a>
      {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE', 'class' => 'float-right']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
      {!! Form::close() !!} 
    @endif
  @endauth

  <hr>
  @include('posts.comments')
@endsection