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

Route::post('users/login', 'UserRestController@loginUser');

Route::get('products', 'ProductRestController@index');
Route::post('products', 'ProductRestController@store');
Route::get('products/{id}', 'ProductRestController@show');
Route::post('update-products/{id}', 'ProductRestController@update');
Route::delete('products/{id}', 'ProductRestController@destroy')->middleware('auth:api');
