<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('web')->group(function () {
    Route::get('/user/current', 'UserController@current');
    Route::get('/user/feed', 'UserController@getMemeFeed');

    Route::delete('/user/{id}', 'UserController@delete');
    Route::get('/user', 'UserController@list');
    Route::get('/user/{id}', 'UserController@get');
    Route::post('/user', 'UserController@create');
    Route::put('/user/{id}', 'UserController@update');

    Route::delete('/tag/{id}', 'TagController@delete');
    Route::get('/tag', 'TagController@list');
    Route::get('/tag/{id}', 'TagController@get');
    Route::post('/tag', 'TagController@create');
    Route::put('/tag/{id}', 'TagController@update');

    Route::delete('/meme/{id}', 'MemeController@delete');
    Route::get('/meme', 'MemeController@list');
    Route::get('/meme/{id}', 'MemeController@get');
    Route::post('/meme', 'MemeController@create');
    Route::put('/meme/{id}', 'MemeController@update');
    Route::patch('/meme/{id}/tags', 'MemeController@updateTags');

    Route::delete('/grade/{id}', 'GradeController@delete');
    Route::get('/grade', 'GradeController@list');
    Route::get('/grade/{id}', 'GradeController@get');
    Route::post('/grade', 'GradeController@create');
    Route::put('/grade/{id}', 'GradeController@update');

    Route::delete('/favorite/{id}', 'FavoriteController@delete');
    Route::get('/favorite', 'FavoriteController@list');
    Route::get('/favorite/{id}', 'FavoriteController@get');
    Route::post('/favorite', 'FavoriteController@create');
    Route::put('/favorite/{id}', 'FavoriteController@update');
});
