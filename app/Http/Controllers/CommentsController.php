<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
  public function list(Post $post)
  {
    $comments = Comment::where('post_id', $post->id)->orderBy('created_at', 'desc')->get();

    return view('posts.show', ['comments' => $comments, 'post' => $post]);
  }

  public function create(Request $request, Post $post)
  {
    $this->validate($request, ['comment' => 'required|max:100']);

    $comment = new Comment();

    $comment->comment = $request->comment;
    $comment->post_id = $post->id;
    $comment->user_id = auth()->user()->id;

    $comment->save();

    return redirect('/posts/' . $post->id)->with('success', 'Comment Added');
  }
}
