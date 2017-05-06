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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/api/get_users', 'ApiController@get_users')->name('get_users');
Route::post('/api/validasi', 'ApiController@validasi')->name('validasi');
Route::post('/api/upload_image', 'ApiController@upload_image')->name('upload_image');
Route::get('/api/get_user/{id}', 'ApiController@get_user')->name('get_user');
