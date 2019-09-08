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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/allpost', 'PostController@post')->name('allpost');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('image', 'ImageController')->middleware('auth');

Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::get('/show/{id}', 'ImageController@showcomment')->name('post.show');


