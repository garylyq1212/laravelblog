@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ Auth::user()->name }}'s Dashboard</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <a href="/posts" class="btn btn-dark">Go To Blog Posts</a>
          <hr class="py-2">

          <h2 class="pb-3">My Posts</h2>            
          <table class="table mt-3">
            <thead>
              <tr>                
                <th scope="col">Post Title</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>            
            @forelse (Auth::user()->posts as $post)
              <tbody>
                <tr>                  
                  <td>
                    <a href='/posts/{{ $post->id }}' class='h4'>{{ $post->title }}</a>
                  </td>
                  <td>                                   
                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-info">Edit</a>
                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE', 'class' => 'float-right']) !!}
                      {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}                    
                  </td>                
                </tr>
              </tbody>
              @empty
                <p>No Posts Found...</p>
                @endforelse
              </table>          
              <a href="/posts/create" class="btn btn-primary">Create Post</a>
              
        </div>
      </div>
    </div>
  </div>
@endsection
