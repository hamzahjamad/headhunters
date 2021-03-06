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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users');
Route::post('/users/{id}/update-access', 'UserController@updateAccess')->name('users.access');

Route::resource('/batches/{bid}/recipients', 'RecipientController',  ['only' => [
    'create', 'edit', 'store', 'update', 'destroy',
]]);
Route::resource('/batches', 'BatchController');
