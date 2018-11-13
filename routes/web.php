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

Route::group(['prefix' => 'posts'],function(){
    Route::get('/','PostController@index')->middleware('auth');
    Route::get('/single/{id}','PostController@post_single');
    Route::get('/delete/{id}','PostController@destroy');
    
    Route::get('/test','PostController@test');
});



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'user'],function(){
    Route::get('/','UserController@index');
    Route::get('/delete/{id}','UserController@destroy');
    Route::post('/','UserController@store');
});

Route::group(['prefix' => 'products'],function(){
    Route::get('/','ProductController@list');
    Route::get('/add_cart/{id}','ProductController@add_cart');
    Route::get('/list_cart','ProductController@list_cart');
});

Route::get('/cart','ProductController@cart');

Route::group(['prefix' => 'chat'],function(){
    Route::get('/', 'ChatController@index');
    Route::get('/all', 'ChatController@all');
    Route::get('/all_better', 'ChatController@all_better');
    Route::post('/', 'ChatController@create');

    Route::get('/original','ChatController@original');
});



Route::get('/update',function(){
    DB::update('update products set name = "APPLE" where id =?',[1]);
});


