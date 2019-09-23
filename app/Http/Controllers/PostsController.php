<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except(['index', 'show']);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::orderBy('created_at', 'desc')->paginate(10);

    return view('posts.index')->with('posts', $posts);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('posts.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // $data = $request->validate([
    //     'title' => 'required|max:255',
    //     'body' => 'required',
    //     'image' => 'image|nullable'
    // ]);

    // Post::create($data);

    $this->validate($request, [
      'title' => 'required|max:255',
      'body' => 'required',
      'image' => 'image|nullable|max:1999'
    ]);

    // Handle File Upload
    if ($request->hasFile('image')) {
      $filenameWithExtension = $request->file('image')->getClientOriginalName();

      $getFilename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

      $getFileExtension = $request->file('image')->getClientOriginalExtension();

      $filenameToStore = $getFilename . '-' . date('Y-m-j H_i_s') . '.' . $getFileExtension;

      $path = $request->file('image')->storeAs('public/posts_images', $filenameToStore);
    } else {
      $filenameToStore = null;
    }

    $post = new Post();
    $post->title = $request->input('title');
    $post->body = $request->input('body');
    $post->user_id = auth()->user()->id;
    $post->image = $filenameToStore;

    $post->save();

    return redirect('/dashboard')->with('success', 'Post Created');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $post = Post::findOrFail($id);

    return view('posts.show')->with('post', $post);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $post = Post::findOrFail($id);

    // return $post;

    // Check for correct user
    if ($post->user_id !== auth()->user()->id) {
      return redirect('/posts')->with('error', 'Unauthorized Page');
    }

    return view('posts.edit')->with('post', $post);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'title' => 'required|max:255',
      'body' => 'required',
      'image' => 'nullable|max:2999'
    ]);

    $post = Post::findOrFail($id);

    // Handle File Upload
    if ($request->hasFile('image')) {
      $filenameWithExtension = $request->file('image')->getClientOriginalName();

      $getFilename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

      $getFileExtension = $request->file('image')->getClientOriginalExtension();

      $filenameToStore = $getFilename . '-' . date('Y-m-j H_i_s') . '.' . $getFileExtension;

      $path = $request->file('image')->storeAs('public/posts_images', $filenameToStore);
    }

    $post->title = $request->input('title');
    $post->body = $request->input('body');

    if ($request->hasFile('image')) {
      // Delete image
      Storage::delete('public/posts_images/' . $post->image);

      $post->image = $filenameToStore;
    }

    $post->save();

    return redirect('/dashboard')->with('success', 'Post Updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $post = Post::findOrFail($id);

    // Delete image
    Storage::delete('public/posts_images/' . $post->image);

    $post->delete();

    return redirect('/dashboard')->with('success', 'Post Removed');
  }
}
