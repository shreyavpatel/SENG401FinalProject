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

Route::get('youtube/whywontitwork/{interests}', 'YoutubeController@mySearch');
Route::get('youtube/show/{url}', 'YoutubeController@show');
Route::post('likes/store', 'LikeController@store');
Route::resource('youtube', 'YoutubeController');

Route::resource('users', 'UserController');
Route::resource('feed', 'FeedController');
Route::resource('likes', 'LikeController');

// Route::get('likes', 'LikeController@index');

Route::get('users/edit/{id}', 'UserController@edit');
// Route::get('youtube/show/{url}', 'YoutubeController@show');
// Route::post('youtube/watchVideo', 'YoutubeController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
