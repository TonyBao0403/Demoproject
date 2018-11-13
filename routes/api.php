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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*Route::middleware('auth:api')->get('/api/posts', function (Request $request) {
    return $request->posts();
});*/
Route::get('/user','UserController@api_index');

Route::group(['prefix' => 'posts'],function(){
    Route::get('/','PostController@api_index');
    Route::get('/{id}','PostController@show');
});


Route::get('/products', 'ProductController@index');