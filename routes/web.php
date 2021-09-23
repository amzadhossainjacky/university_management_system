<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware'=> ['admin', 'auth'], 'namespace'=> 'admin'],function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
});
Route::group(['prefix' => 'user', 'middleware'=> ['user', 'auth'], 'namespace'=> 'user'],function () {
    Route::get('dashboard', 'UserController@index')->name('user.dashboard');
});

