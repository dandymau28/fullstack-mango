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

Route::get('/', 'WebController\DashboardController@index')->name('index');

Route::get('/komik/{id}', 'WebController\KomikController@show');

Route::get('/buku/{id}','WebController\BukuController@show');

// Route::get('/komik', 'WebController\KomikController@showKomik');