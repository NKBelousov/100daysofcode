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