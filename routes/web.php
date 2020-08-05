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


Route::get('/', 'programController@landing')->name('landing');

Route::resource('detail-user', 'detailController');
Route::resource('program', 'programController');

Route::get('all-program', 'programController@beranda')->name('all-program.beranda');
Route::get('chart', 'programController@chart')->name('chart');
Route::get('detail-post/{id}', 'programController@detail_post')->name('detail-post');
Route::delete('delete-program/{program:photo}', 'programController@hapus')->name('hapus');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
