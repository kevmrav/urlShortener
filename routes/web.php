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

//Pass in original (source) url and convert to shortened url
Route::get('/convert-url/{originalUrl}', 'UrlMapController@store');

//Pass in shortened url and redirect to original url site
Route::get('/{shortUrl}', 'UrlMapController@show');

Route::get('/', function () {
    abort(404);
});
