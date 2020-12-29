<?php

use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', function () {
    Alert::success('hello');
    return view('welcome');
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
    Route::get('transaction', 'TransactionController@index')->name('transaction.index');
    Route::get('transaction/{code}/{status}', 'TransactionController@status');
});
