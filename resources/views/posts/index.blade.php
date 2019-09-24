@extends('layouts.app')

@section('content')
  <h1 class="display-4">Posts</h1>
  {{-- @if (count($posts) > 0)
    @foreach ($posts as $post)
      <div class="card card-body">
        <h3 class="card-title">{{ $post->title }}</h3>
        <p class="card-text">{{ $post->body }}</p>
      </div>                
    @endforeach
  @else
    <p>No Posts Found...</p>
  @endif --}}

  {{-- Same As Above --}}
  @forelse ($posts as $post)
    <div class="card card-body mb-2">
      <div class="row">
        @if ($post->image)
          <div class="col-6 col-md-4">
            <img src="{{ Storage::disk('s3')->url($post->image) }}" alt="post image" width="300px" height="300px">
          </div>
        @endif
        <div class="col-12 col-md-8">
          <a href="/posts/{{ $post->id }}" class="card-title h3 text-primary">{{ $post->title }}</a>
          <p class="h6 card-text">
            Written by <strong>{{ $post->user->name }}</strong> on {{ $post->created_at }}
          </p>      
        </div>
      </div>
    </div>
  @empty
    <p>No Posts Found...</p>
  @endforelse  
@endsection