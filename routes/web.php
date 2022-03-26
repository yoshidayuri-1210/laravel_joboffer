<?php
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

Route::patch('/items/{item}/toggle_like', 'ItemController@togglelike')->name('items.toggle_like');
Route::get('/likes', 'LikeController@index')->name('likes.index');

Route::patch('orders/{item}/confirm', 'OrderController@confirm')->name('orders.confirm');
Route::patch('/orders/{item}', 'OrderController@store')->name('orders.store');
//検索結果
Route::get('/area/{area}', 'ItemController@index')->name('items.index');
Route::get('/category/{category}', 'ItemController@category')->name('items.category');
Route::get('/type/{type}', 'ItemController@type')->name('items.type');
Route::get('/employment/{employment}', 'ItemController@employment')->name('items.employment');
Route::get('/search', 'ItemController@search')->name('items.search');

Route::get('items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');
Route::patch('/items/{item}/edit_image', 'ItemController@updateImage')->name('items.update_image');