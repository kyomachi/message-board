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


Route::get('/', function () {
    return view('welcome');
});

// CRUD
Route::get('messages/{id}', 'MessagesController@show');
Route::post('messages', 'MessagesController@store');
Route::put('messages/{id}', 'MessagesController@update');
Route::delete('messages/{id}', 'MessagesController@destroy');

// index: showの補助ページ
Route::get('messages', 'MessagesController@index');

// create: 新規作成用のフォームページ
Route::get('messages/create', 'MessagesController@create');

// edit: 更新用のフォームページ
Route::get('messages/{id}/edit', 'MessagesController@edit');
*/
Route::get('/', 'MessagesController@index');

Route::resource('messages', 'MessagesController');
