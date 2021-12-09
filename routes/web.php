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
            Route::get('edit/{id}','Admin\CategoryController@edit')->name('category.edit');
            Route::post('store','Admin\CategoryController@store')->name('category.store');
            Route::post('update/{id}','Admin\CategoryController@update')->name('category.update'); //update
            Route::post('update-status','Admin\CategoryController@status')->name('category.status'); //trạng thái
            Route::get('destroy/{id}','Admin\CategoryController@destroy')->name('category.destroy'); // nổi bật
        });

        Route::prefix('product')->group(function () {
            Route::get('index','Admin\ProductController@index')->name('product.index');
            Route::get('add','Admin\ProductController@add')->name('product.add');
            Route::get('edit/{id}','Admin\ProductController@edit')->name('product.edit');
            Route::post('store','Admin\ProductController@store')->name('product.store');
            Route::post('update/{id}','Admin\ProductController@update')->name('product.update'); //update
            Route::post('update-status','Admin\ProductController@status')->name('product.status'); //trạng thái nb
            Route::post('update-selling','Admin\ProductController@selling')->name('product.selling'); //trạng thái sel
            Route::get('destroy/{id}','Admin\ProductController@destroy')->name('product.destroy'); // nổi bật
        });

    });
});
