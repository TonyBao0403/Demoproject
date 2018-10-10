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

Route::get('/posts','PostController@index');
Route::get('/posts/{id}','PostController@show');
Route::post('/posts','PostController@store');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user','UserController@index');
Route::get('/user/delete/{id}','UserController@destroy');
Route::post('/user','UserController@store');