@extends('layouts.app')

@section('content')
  <div class="jumbotron">
    <h1 class="display-4">{{ $title }}</h1>
    <p class="lead">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ad, inventore nulla. Officia fugit quam nulla libero nemo rem ullam deserunt.</p>
    <hr class="my-4">            
    <a class="btn btn-primary btn-lg" href="/posts" role="button">Visit Blog Posts</a>
  </div>
@endsection