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

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/memes', 'MemeController@memes')->name('memes');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/tags', 'TagController@tags')->name('tags');
    Route::get('/users', 'UserController@users')->name('users');
    Route::get('/{feed?}', 'UserController@feed')->name('feed');
});
