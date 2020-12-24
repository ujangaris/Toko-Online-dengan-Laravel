<?php

use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', function () {
    Alert::success('hello');
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->group(function(){

    Route::get('dashboard', 'HomeController@index');
    /* Route::get('category', 'CategoryController@index');
    Route::post('category', 'CategoryController@store')->name('admin.category'); */
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
});
