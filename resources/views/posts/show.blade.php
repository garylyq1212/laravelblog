@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-dark mb-4">Go To Blog Posts</a>
  <h1>{{ $post->title }}</h1>
  <small>Written by <strong>{{ $post->user->name }}</strong> on {{ $post->created_at }}</small>
  <hr>
  @if ($post->image)
    <img src="/storage/posts_images/{{ $post->image }}" alt="post image" width="300px" height="300px">  
  @endif
  <p>{{ $post->body }}</p>
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