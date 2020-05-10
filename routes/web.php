<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Web\WelcomeController@index')->name('home');

Auth::routes();

Route::get('/posts/{city}/{postType}', 'Api\PostController@index')->name('posts');

Route::get('{path}', 'Web\WelcomeController@index')->where('path', '([A-z\d\-/_.]+)?');
