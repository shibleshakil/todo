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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::post('todo', 'App\Http\Controllers\HomeController@store')->name('todo');
Route::DELETE('todo/delete', 'App\Http\Controllers\HomeController@delete')->name('tododelete');
