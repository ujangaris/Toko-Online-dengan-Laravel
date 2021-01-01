<?php

use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', function () {
    Alert::success('hello');
    return view('welcome');
    /* $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();*/
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix('admin')->middleware('auth')->group(function(){

    Route::get('dashboard', 'HomeController@index');
    /* Route::get('category', 'CategoryController@index');
    Route::post('category', 'CategoryController@store')->name('admin.category'); */
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');

    // transaction
    Route::get('transaction', 'TransactionController@index')->name('transaction.index');
    Route::get('transaction/{code}/{status}', 'TransactionController@status');
    Route::get('transaction/{code}/detail/data', 'TransactionController@detail');
    Route::get('transaction/{code}/detail/data/cetak', 'TransactionController@cetakpdf');

    // users
    Route::get('user', 'UserController@index')->name('admin.user');
    Route::get('user/status/{id}', 'UserController@changestatus');
    Route::get('user/add', 'UserController@create')->name('admin.user.create');
    Route::post('user/add', 'UserController@store')->name('admin.user.store');
});
