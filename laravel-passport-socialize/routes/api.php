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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', 'ProductRestController@index');
Route::post('posts', 'ProductRestController@store');
Route::get('posts/{id}', 'ProductRestController@show');
Route::post('update-posts/{id}', 'ProductRestController@update');
Route::delete('posts/{id}', 'ProductRestController@destroy')->middleware('auth:api');
