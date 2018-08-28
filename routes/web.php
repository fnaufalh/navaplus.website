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

Route::get('/agency/{id}', function ($id) {
    return view('agency')
        ->with([
            'id' => $id
        ]);
});

Route::get('/services', function () {
    return view('clients');
});

Route::get('/autocomplete', function () {
    return view('autocomplete');
});

/**
 * Semua return view disini balikinnya .blade.php yang ada di resources/views
 * Untuk aksesnya pake . ex: news.index
 *
 * Kalau mau terima parameter bisa pake {...} ex: /news/{id}/{page}
 * Jadi linknya localhost/news/1/20
 *
 * Dan perlu diinget, di parameter function perlu diisi sesuai nama namanya
 * ex: function($id, $page){
 *      // do something
 *      // Bisa akses $id, $page sebagai variable
 *
 *      // Kalau mau lempar variable ke viewnya pake with
 *      // Bisa pake array, atau langsung
 *      //    ex: ->with('id', $id)   Cuma satu
 *      //        ->with([
 *      //            'id' => $id,
 *      //            'cur_page' => $page
 *      //        ])
 *
 *      // Nanti disana tinggal akses pake {{$[key_name]}} ex: {{$id}} atau {{$cur_page}}
 *
 *      return view('news.detail')
 *          ->with(['id' => $id]);
 *
 * }
 *
 *
 */
