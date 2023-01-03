<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PageController@home')->name('home');

Route::get('profile', 'UserController@profile')->name('profile');

Route::delete('user', 'UserController@destroy')->name('users.destroy');
Route::post('user/change_password', 'UserController@changePassword')->name('users.change_password');

Route::get('contacts', 'PageController@contacts')->name('contacts');

Route::get('antidoping', 'PageController@antidoping')->name('antidoping');

Route::get('records', 'PageController@records')->name('records');

Route::resource('posts', 'PostController')->only(['index', 'destroy']);
Route::post('posts/{post}/comment', 'PostController@comment')->name('posts.comment');

Route::resource('comments', 'CommentController');

Route::resource('albums', 'AlbumController');

Route::resource('news', 'NewsController');

Route::resource('tournaments', 'TournamentController');

Route::resource('contests', 'ContestController');

Route::resource('board_meetings', 'BoardMeetingController');

Route::resource('member_meetings', 'MemberMeetingController');

Route::post('files/upload', 'FileController@upload')->name('files.upload');