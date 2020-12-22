<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->group(function(){
    Route::get('dashboard', 'HomeController@index');
    Route::get('category', 'CategoryController@index');
});
