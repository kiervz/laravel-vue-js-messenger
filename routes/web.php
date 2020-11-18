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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

Route::resource('message', 'MessageController');
Route::resource('contact', 'ContactController');

Route::get('/conversation/{id}', 'ContactController@getMessageFor');
Route::post('/conversation/send', 'ContactController@send');