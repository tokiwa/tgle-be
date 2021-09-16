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

Route::group(['middleware' => ['api']], function() {
    Route::post('test2', 'MainController@postdata');
});

Route::group(['middleware' => ['api']], function() {
    Route::post('test', 'MainController@receivedata');
});

Route::group(['middleware' => ['api']], function() {
    Route::post('test4a', 'MainController@test4a');
});

//Default setting
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

