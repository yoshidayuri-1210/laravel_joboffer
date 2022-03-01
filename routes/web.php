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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'ItemController@top')->name('items.top');

Auth::routes();

//求人投稿
Route::resource('items', 'ItemController');

//いいね求人
Route::resource('likes', 'LikeController')->only(['index', 'store', 'destroy']);

//ユーザープロフィール
Route::resource('users', 'UserController')->only(['show']);
Route::get('/profile/edit', 'UserController@edit')->name('profile.edit');
Route::patch('/profile', 'UserController@update')->name('profile.update');

// 投稿詳細
//Route::get('/items/{id}', 'ItemsController@show')->name('items.show');
