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

//    $filterCondition = [
//        'all' => ['y', 'n'],
//        'order_by' => ['id', 'name'],
//        'order_type' => ['asc', 'desc']
//    ];
//
//    $filter = $request->all();
//
//    $all = (isset($filter['all']) &&
//        in_array($filter['all'], $filterCondition['all'])) ? $filter['all'] : 'y';
//    $orderBy = (isset($filter['order_by']) &&
//        in_array($filter['order_by'], $filterCondition['order_by'])) ? $filter['order_by'] : 'id';
//    $orderType = (isset($filter['order_type']) &&
//        in_array($filter['order_type'], $filterCondition['order_type'])) ? $filter['order_type'] : 'desc';
//    $take = (isset($filter['take']) &&
//        is_numeric($filter['take'])) ? $filter['take'] : null;

    $data = \App\Slider::orderBy('id', 'asc')
        ->get();

//    if ($all == 'y')
//        $data = $data->withTrashed();
//    if ($take)
//        $data = $data->take($take);

//    $data = $data->get();

    foreach ($data as $item) {
        $item->image_horizontal_link = env('IMAGE_PATH').$item->image_horizontal;
        $item->image_potrait_link = env('IMAGE_PATH').$item->image_potrait;
    };

    $slider = json_encode($data);
//   dd($slider);
    return view('home')->with([
        'slider' => $slider
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

Route::get('/clients', function () {
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
