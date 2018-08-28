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

use App\News;

Route::get('/', function () {
    return view('home');
});

Route::get('/contact-us', function () {
    return view('home')
        ->with([
            'contact_us' => true
        ]);
});

Route::get('/news', function () {
    return view('news.index');
});

Route::get('/news/{id}', function ($id) {
    return view('news.detail')
        ->with([
            'id' => $id
        ]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/work', function () {
    return view('work.index');
});

Route::get('/work/{id}', function ($id) {
    return view('work.detail')
        ->with([
            'id' => $id
        ]);
});

Route::get('/agency/{name}', function ($name) {

    $agency = \App\Agency::where('name', $name)
        ->first();

    if($agency == NULL)
        abort(404);

    return view('agency')
        ->with([
            'id' => $agency->id
        ]);
});

Route::get('/services', function () {
    return view('clients');
});

Route::get('/autocomplete', function () {
    return view('autocomplete');
});
