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