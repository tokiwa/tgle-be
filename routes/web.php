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

Route::get('api/sample', function (){
     return 'Sample';
});

//json
Route::get('api/json', function () {
    return response()->json([
        'name' => '田中',
        'id' => 1
    ]);
});

//json
Route::get('api/resp', 'RespController@index');

// ajax, json sample program
Route::get('/test1', function () {
    return view('index');
});
Route::post('/test1', 'MainController@write1');

// original
Route::get('/', function () {
    return view('welcome');
});
