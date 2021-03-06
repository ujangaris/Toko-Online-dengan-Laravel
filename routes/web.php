<?php

use Illuminate\Routing\RouteGroup;
use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', 'homepage\BerandaController@index');
Route::get('/product', 'homepage\BerandaController@product');
Route::get('/category/{slug}', 'homepage\BerandaController@productbycategory')->name('category.product');
Route::get('/supplier/{id}', 'homepage\BerandaController@productbysupplier');
Route::get('/product/detail/{slug}', 'homepage\BerandaController@detail');
//
Route::get('/supplier', 'homepage\BerandaController@supplier');
Route::get('/auth/register', 'AuthController@register');
Route::post('/auth/register', 'AuthController@store')->name('home.register');
Route::get('/verifikasi/register/{token}', 'AuthController@verif');
Route::post('/auth/login', 'AuthController@login');
// 'Cart
Route::post('/cart', 'CartController@index');
Route::get('/keranjang', 'CartController@keranjang');
Route::post('/cart/update', 'CartController@update');
Route::get('/cart/delete/{rowid}', 'CartController@delete');
Route::get('/cart/formulir', 'CartController@formulir');
Route::post('/cart/transaction', 'CartController@transaction');
Route::get('/cart/myorder', 'CartController@myorder');
Route::get('/cart/detail/{code}', 'CartController@detail');

Route::group(['middleware' => ['oauth:supplier']], function () {

    // supplier
    // Route::get('/myproduct', 'CartController@myproduct')->middleware('oauth:suplier');
    Route::get('/myproduct', 'CartController@myproduct');
    Route::get('/addproduct', 'CartController@addproduct');
    Route::post('/addproduct', 'CartController@saveproduct');
    Route::get('/editproduct/{id}', 'CartController@editproduct');
    Route::post('/editproduct', 'CartController@updateproduct');
    Route::get('/deleteproduct/{id}', 'CartController@deleteproduct');
});
Route::get('/myprofil', 'homepage\BerandaController@myprofil');
Route::post('/updateprofil', 'homepage\BerandaController@updateprofil');
Route::get('/logout', 'homepage\BerandaController@logout');

// Route::get('/', function () {
//     Alert::success('hello');
//     return view('welcome');
//     /* $pdf = App::make('dompdf.wrapper');
//     $pdf->loadHTML('<h1>Test</h1>');
//     return $pdf->stream();*/
// });


Auth::routes();
Route::get('citybyid/{id}', function ($id) {
    return city($id);
});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix('admin')->middleware('oauth:admin')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');

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
    Route::get('user/edit/{id}', 'UserController@edit');
    Route::post('user/update', 'UserController@update');
    Route::get('user/delete/{id}', 'UserController@delete');
});
