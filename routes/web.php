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

Route::get('/posts',function(){
    return view('post');
});
Route::get('/posts/{id}',function($id){
    return view('post_single',[
        'id' => $id
    ]);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user','UserController@index');
Route::get('/user/delete/{id}','UserController@destroy');
Route::post('/user','UserController@store');

Route::get('/products','ProductController@list');
Route::get('/products/add_cart/{id}','ProductController@add_cart');
Route::get('/products/list_cart','ProductController@list_cart');
Route::get('/cart','ProductController@cart');

Route::get('/chat', 'ChatController@index');
Route::get('/chat/all', 'ChatController@all');
Route::get('/chat/all_better', 'ChatController@all_better');
Route::post('/chat', 'ChatController@create');