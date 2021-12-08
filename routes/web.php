<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('login','Admin\AuthController@login')->name('admin.login');
    Route::get('logout','Admin\AuthController@logout')->name('admin.logout');
    Route::post('post-login','Admin\AuthController@postLogin')->name('admin.post.login');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard','Admin\AdminController@dashboard')->name('admin.dashboard');
        Route::get('/','Admin\AdminController@dashboard')->name('admin.dashboard');

        Route::prefix('category')->group(function () {
            Route::get('index','Admin\CategoryController@index')->name('category.index');
            Route::get('add','Admin\CategoryController@add')->name('category.add');
            Route::get('edit','Admin\CategoryController@edit')->name('category.edit');
            Route::post('store','Admin\CategoryController@store')->name('category.store');
        });

    });
});
