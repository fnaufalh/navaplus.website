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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/agency', 'AgencyController@list');
Route::get('/agency/{id}', 'AgencyController@detail');

Route::get('/work', 'WorkController@list');
Route::get('/work/{id}', 'WorkController@detail');
Route::get('/work/category/{id}', 'CategoryController@workByCategory');

Route::get('/people', 'PeopleController@list');
Route::get('/people/{id}', 'PeopleController@detail');

Route::get('/news', 'NewsController@list');
Route::get('/news/{id}', 'NewsController@detail');

Route::get('/category', 'CategoryController@list');
Route::get('/category/{id}', 'CategoryController@detail');

Route::get('/client', 'ClientController@list');
Route::get('/client/{id}', 'ClientController@detail');

Route::get('/about', 'AboutController@detail');

Route::get('/slider', 'SliderController@list');
Route::get('/setting', 'SettingController@detail');
