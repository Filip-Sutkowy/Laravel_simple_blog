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

Auth::routes();

Route::get('/', 'Article\ArticleController@index')->name('Home');

Route::resource('articles', 'Article\ArticleController');
Route::resource('articles.comments', 'Article\ArticleCommentController', ['only' => ['store']]);

Route::resource('users', 'User\UserController', ['only' => ['index', 'show']]);
Route::resource('users.articles', 'User\UserArticleController', ['only' => ['index']]);
Route::resource('users.comments', 'User\UserCommentController', ['only' => ['index']]);

Route::resource('comments', 'Comment\CommentController', ['only' => ['destroy']]);
