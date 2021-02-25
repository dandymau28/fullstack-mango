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

    Route::get('/profil/{id}', 'WebController\ProfilUserController@show');

    Route::get('/logout', 'WebController\AuthController@logout');
});


// Route::get('/komik', 'WebController\KomikController@showKomik');