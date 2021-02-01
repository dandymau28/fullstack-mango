<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route Auth
Route::post('/register', 'AuthController@register');
Route::put('/user/{code}/verifikasi', 'AuthController@verification'); 
Route::post('/login', 'AuthController@login')->name('login');

Route::middleware('auth:api')->group(function() {
    //Route Buku
    Route::get('/buku', 'BukuController@index');
    Route::get('/buku/{buku_id}/komik', 'KomikController@showByBuku');
    
    //Route Komik
    Route::get('/komik/{komik_id}', 'KomikController@showById');
    Route::get('/komik', 'KomikController@index');
    Route::get('/komik/{komik_id}/materi', 'MateriController@showByIdKomik');
    Route::get('/komik/{komik_id}/ujian', 'UjianController@showByIdKomik');
    Route::get('/komik/{komik_id}/komentar', 'KomentarController@showByIdKomik');
    Route::post('/komik/{komik_id}/komentar', 'KomentarController@storeByIdKomik');
    
    //Route Ujian
    Route::get('/ujian/{ujian_id}/soal', 'SoalController@showByIdUjian');
    Route::post('/ujian/{ujian_id}', 'UjianController@storeByIdUjian'); 
    
    //Route Soal
    Route::get('/soal/{soal_id}/jawaban', 'PilihanJawabanController@showByIdSoal');
    
    // Route Nilai
    Route::get('/nilai', 'NilaiController@index');
    Route::get('/nilai/{ujian_id}/ujian', 'NilaiController@showByIdUjian');
    Route::get('/user/{user_id}/nilai', 'NilaiController@showByIdUser'); 
    
    // Route User
    Route::get('/user/{user_id}', 'UserController@showByIdUser');
    Route::put('/user/{user_id}', 'UserController@updateByIdUser');
    Route::put('/user/{user_id}/ubah-sandi', 'UserController@updatePasswordByIdUser');

    //Route Logout
    Route::post('/logout', 'AuthController@logout');


});