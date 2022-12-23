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

Auth::routes(['verify' => false, 'reset' => false]);

Route::get('/', 'AboutController@home')->name('home');

Route::get('dashboard', 'UserController@dashboard')->name('dashboard');
Route::get('user/profile', 'UserController@profile')->name('profile');

Route::get('about/contacts', 'AboutController@contacts')->name('about.contacts');
Route::get('about/meetings', 'AboutController@meetings')->name('about.meetings');

Route::get('antidoping', 'AboutController@antidoping')->name('antidoping');
Route::get('records', 'AboutController@records')->name('records');

Route::post('posts/{post}/comment', 'PostController@comment')->name('posts.comment');
Route::resource('posts', 'PostController');

Route::resource('comments', 'CommentController');

Route::resource('albums', 'AlbumController');

Route::resource('news', 'NewsController');

Route::resource('tournaments', 'TournamentController');

Route::resource('contests', 'ContestController');

Route::resource('board_meetings', 'BoardMeetingController');

Route::resource('member_meetings', 'MemberMeetingController');

Route::post('files/upload', 'FileController@upload')->name('files.upload');