<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (env('APP_ENV') === 'production') {
  URL::forceScheme('https');
}

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::resource('posts', 'PostsController');

Route::get('/posts/{post}', 'CommentsController@list');
Route::post('/posts/{post}', 'CommentsController@create');
