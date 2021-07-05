<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

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

//Route::resource('products', 'App\Http\Controllers\ProductController');

//public routes
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::get('/products', 'App\Http\Controllers\ProductController@index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show');
Route::get('/products/search/{name}','App\Http\Controllers\ProductController@search');


//protected routes
Route:: group(['middleware'=>['auth:sanctum']], function () {
    Route::post('/products','App\Http\Controllers\ProductController@store');
    Route::put('/products/{id}', 'App\Http\Controllers\ProductController@update');
    Route::delete('/products/{id}', 'App\Http\Controllers\ProductController@destroy');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
});




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
