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
    Route::post('posttest', 'MainController@posttest');
});

Route::group(['middleware' => ['api']], function() {
    Route::post('postkeyword', 'MainController@postkeyword');
});

Route::group(['middleware' => ['api']], function() {
    Route::post('postlesson', 'MainController@postlesson');
});

Route::group(['middleware' => ['api']], function() {
    Route::get('getlesson', 'MainController@getlesson');
});

Route::group(['middleware' => ['api']], function() {
    Route::get('getkeyword', 'MainController@getkeyword');
});

//Default setting
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

