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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'IndexController@overview');
Route::get('/albums/{id}', 'AlbumController@detail');
Route::get('/artists/{id}', 'ArtistController@detail');
Route::get('/bands/{id}', 'BandController@detail');
Route::get('/login', 'SigninController@begin');

Route::get('/album/add', 'AlbumController@add')->middleware('auth');
Route::post('/album/add', 'AlbumController@store')->middleware('auth');

Route::get('/artist/add', 'ArtistController@add')->middleware('auth');
Route::post('/artist/add', 'ArtistController@store')->middleware('auth');

Route::get('/band/add', 'BandController@add')->middleware('auth');
Route::post('/band/add', 'BandController@store')->middleware('auth');

Route::get('/albums/{id}/edit', 'AlbumController@edit')->middleware('auth');
Route::get('/artists/{id}/edit', 'ArtistController@edit')->middleware('auth');
Route::get('/bands/{id}/edit', 'BandController@edit')->middleware('auth');

Route::post('/albums/{id}/edit', 'AlbumController@update')->middleware('auth');
Route::post('/artists/{id}/edit', 'ArtistController@update')->middleware('auth');
Route::post('/bands/{id}/edit', 'BandController@update')->middleware('auth');

Route::get('/albums/{id}/delete', 'AlbumController@delete')->middleware('auth');
Route::get('/artists/{id}/delete', 'ArtistController@delete')->middleware('auth');
Route::get('/bands/{id}/delete', 'BandController@delete')->middleware('auth');

Route::get('/search', 'SearchController@overview');
Route::post('/search', 'SearchController@search');

//autocomplete
Route::get('autocomplete', 'AlbumController@autocomplete')->name('autocomplete');

Auth::routes();
//links work with GET
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
