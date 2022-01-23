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




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register','API\RegisterController@register');

Route::post('login','API\RegisterController@login');

Route::middleware('auth:api')->get('/user/revoke', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return 'tokens are delete';
});


Route::middleware('auth:api')->group(function ()
{
    Route::get('index','API\RegisterController@index');
    Route::post('updateuser','API\RegisterController@UpdateUser');
});
/*Route::middleware('auth:api')->group(function ()
{
    Route::resources(['products','API\ProductsController']);
});*/
