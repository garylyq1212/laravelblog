<h3 class="my-4">Comments</h3>
@auth  
  {!! Form::open(['action' => ['CommentsController@create', $post->id], 'class' => 'my-3']) !!}
    <div class="form-group">
      {!! Form::text('comment', '', ['class' => 'form-control', 'placeholder' => 'Add a comment...']) !!}
    </div>
    {!! Form::submit('Add Comment', ['class' => 'btn btn-primary float-right']) !!}
  {!! Form::close() !!}   
  <br>
  <br>
@endauth
@guest
  <p><strong>Please Log in to post your comment</strong></p>
@endguest
@forelse ($comments as $comment)
  <div class="card card-body mt-2">
    <h5 class="card-text">
      <strong>{{ $comment->user->name }}</strong>
    </h5>
    <small class="pb-3">{{ $comment->created_at }}</small>
    <p>{{ $comment->comment }}</p>
  </div>
  @empty
    <p class="mt-5">No Comments Found...</p>
@endforelse