<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use App\Models\Item;

Route::get('/',function(){
      return view('register');
});

Route::get('/items', 'App\Http\Controllers\ItemController@index');

Route::resource('items','App\Http\Controllers\ItemController');
Route::resource('likes', 'App\Http\Controllers\LikeController')->only([
  'index', 'store', 'destroy'
]);

Auth::routes();

Route::get('/items/{item}/edit_image','App\Http\Controllers\ItemController@editImage')->name('items.edit_image');
Route::patch('/items/{item}/edit_image', 'App\Http\Controllers\ItemController@updateImage')->name('items.update_image');

Route::get('/users/{user}/show', 'App\Http\Controllers\UserController@show')->name('users.show');
Route::get('/users/edit', 'App\Http\Controllers\UserController@edit')->name('users.edit');
Route::patch('/users/edit', 'App\Http\Controllers\UserController@update')->name('users.update');
Route::get('/users/{id}/edit_image', 'App\Http\Controllers\UserController@editImage')->name('users.edit_image');
Route::patch('/users/edit_image', 'App\Http\Controllers\UserController@updateImage')->name('users.update_image');
 
//Route::resource('users', 'UserController')->only([
  //'show','store'
//]);
Route::get('/users/{user}/exhibitions', 'App\Http\Controllers\UserController@exhibitions')->name('users.exhibitions');

Route::patch('/items/{item}/toggle_like', 'App\Http\Controllers\ItemController@toggleLike')->name('items.toggle_like');

Route::get('/items/{item}/comfirm','App\Http\Controllers\ItemController@comfirm')->name('items.comfirm');
Route::get('/items/{item}/finish','App\Http\Controllers\ItemController@finish')->name('items.finish');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
