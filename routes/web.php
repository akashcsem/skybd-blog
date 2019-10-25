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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// routes for admins
Route::group(['prefix'=>'admin', 'as'=>'admin.', 'namespace'=>'Admin', 'middleware'=>['auth', 'admin']], function() {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
});




// routes for authors
Route::group(['prefix'=>'author', 'as'=>'author.', 'namespace'=>'Author', 'middleware'=>['auth', 'author']], function() {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});
