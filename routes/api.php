<?php

use App\Models\User;
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

Route::prefix('v1')->group(function(){
    Route::middleware('auth:sanctum')->group(function() {

        Route::post('user/{user}/updateAvatar', 'Api\UserAvatarController@store');

        Route::put('user/{user}/updatePassword', 'Api\AuthController@updatePassword');
        Route::put('user/{user}', 'Api\UserController@update');
        Route::get('user', 'Api\UserController@getUser');

        Route::post('createPost', 'Api\PostController@store');
        Route::get('user/{user}/post', 'Api\PostController@getUserPost');
        Route::put('post/{post}/update', 'Api\PostController@update');
    });

    Route::get('post/{post}', 'Api\PostController@getPost');
    Route::post('login', 'Api\AuthController@login')->name('login');
    Route::post('register', 'Api\AuthController@register')->name('register');
    Route::get('cities', 'Api\CityController@index')->name('cities');

});