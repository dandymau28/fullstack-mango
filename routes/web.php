<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', 'WebController\AuthController@view')->name('login');
Route::post('/login', 'WebController\AuthController@login')->name('login-post');
Route::get('/register', 'WebController\AuthController@register_view');
Route::post('/register', 'WebController\AuthController@register')->name('register');

Route::group([
    'middleware' => 'auth'
], function($router) {
    Route::get('/', 'WebController\DashboardController@index')->name('index');
    
    Route::get('/komik/{id}', 'WebController\KomikController@show');
    
    Route::get('/buku/{id}','WebController\BukuController@show');
    
    Route::post('/komentar', 'WebController\KomentarController@store');

    Route::get('/latihan/{id}', 'WebController\UjianController@show');
    Route::post('/latihan/{id}', 'WebController\UjianController@store');

    Route::get('/leaderboard', 'WebController\NilaiController@index');

    Route::get('/profil', 'WebController\ProfilUserController@show');
    Route::post('/profil', 'WebController\ProfilUserController@update');

    Route::get('/logout', 'WebController\AuthController@logout');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin-page'
], function($router) {
    Route::get('/','AdminController\DashboardController@index');
    Route::get('/buku','AdminController\BukuController@index')->name('admin-buku');
    Route::post('/buku', 'AdminController\BukuController@store')->name('store-buku');
    Route::get('/buku/{id}', 'AdminController\BukuController@edit');
    Route::post('/buku/{id}', 'AdminController\BukuController@update');
    Route::get('/buku/{id}/delete', 'AdminController\BukuController@destroy');

    Route::get('/komik', 'AdminController\KomikController@index')->name('admin-komik');
    Route::get('/komik/add', 'AdminController\KomikController@create')->name('tambah-komik');
    Route::post('/komik', 'AdminController\KomikController@store');
    Route::get('/komik/{id}', 'AdminController\KomikController@edit')->name('edit-komik');
    Route::post('/komik/{id}', 'AdminController\KomikController@update');
    Route::get('/komik/{id}/delete', 'AdminController\KomikController@destroy')->name('delete-komik');
});
// Route::resource('/datatables', 'AdminController\BukuController')->only([
//     'dataBuku'
// ]);
// Route::get('/data-buku','AdminController\BukuController@dataBuku')->name('data-buku');
// Route::get('/komik', 'WebController\KomikController@showKomik');