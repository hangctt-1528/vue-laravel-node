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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/register', 'AuthController@register');

Route::group(['namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login')->name('login');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/items/create', 'ItemController@store');
    Route::get('/items', 'ItemController@index');
    Route::put('/items/{item}', 'ItemController@update');
    Route::get('/items/edit/{item}', 'ItemController@edit');
});
