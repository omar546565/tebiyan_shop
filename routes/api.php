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


Route::post('login2', 'AuthController@login');
Route::post('logout2', 'AuthController@logout');
Route::post('refresh2', 'AuthController@refresh');
Route::post('me2', 'AuthController@me');

Route::middleware('auth:api')->group(function ()
{
    Route::get('home','API\HomeController@index2');
    Route::get('profile','API\HomeController@Profile');
    Route::get('categories','API\HomeController@Categories');
    Route::get('favorites','API\HomeController@FavoritesGet');
    Route::post('favorites','API\HomeController@Favorites');
    Route::post('products/search','API\HomeController@productsSearch');

});
Route::get('homeapi','API\HomeController@index2');
Route::middleware('auth:api2')->group(function ()
{
    Route::get('index2','AuthController@index2');

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
    Route::put('updateuser','API\RegisterController@UpdateUser');
});
/*Route::middleware('auth:api')->group(function ()
{
    Route::resources(['products','API\ProductsController']);
});*/
