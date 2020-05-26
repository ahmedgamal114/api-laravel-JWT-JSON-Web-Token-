<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::Post('/user/register', 'ApiRegisterController@register');
Route::post('/user/login', 'ApiLoginController@login');


Route::middleware('jwt.auth')->get('/users', function (Request $request) {
    Route::post('/user/login', 'ApiLoginController@login');

});

Route::resource('books', 'API\bookController');
Route::middleware('jwt.auth')->group( function () {
    Route::resource('books', 'API\BookController');

});