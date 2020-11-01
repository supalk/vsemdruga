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


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/pet/add', 'PetController@add')->name('pet_add');
Route::get('/pet/{id}', 'PetController@edit')->name('pet_add');
Route::post('/pet/route', 'PetController@routeMe')->name('petController');

Route::get('/lib/{name}', 'LibController@page')->name('lib');
Route::post('/lib/{name}/get', 'LibController@list')->name('lib_get');
Route::post('/lib/{name}/save', 'LibController@save')->name('lib_save');

Route::get('/catalog', 'CatalogController@page')->name('catalog');
Route::post('/catalog', 'CatalogController@list');

/*Route::get('/test', function () {
    return view('welcome');
});*/
Route::get('/reports', 'PetController@reports');

Route::get('/data/img/{param}/{img}', 'HomeController@getPhoto')
    ->where('img', '.*')
    ->name('getPhoto');