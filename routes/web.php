<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('login','Admin\AuthController@login')->name('admin.login');
    Route::get('logout','Admin\AuthController@logout')->name('admin.logout');
    Route::post('post-login','Admin\AuthController@postLogin')->name('admin.post.login');

    Route::middleware('auth')->group(function () {
        Route::get('change-password','Admin\AuthController@getChangePass')->name('admin.get.change.pass');
        Route::post('change-password','Admin\AuthController@postChangePass')->name('admin.post.change.pass');
        Route::get('dashboard','Admin\AdminController@dashboard')->name('admin.dashboard');
        Route::get('/','Admin\AdminController@dashboard')->name('admin.dashboard');

        Route::prefix('category')->group(function () {
            Route::get('index','Admin\CategoryController@index')->name('category.index');
            Route::get('add','Admin\CategoryController@add')->name('category.add');
            Route::get('edit/{id}','Admin\CategoryController@edit')->name('category.edit');
            Route::post('store','Admin\CategoryController@store')->name('category.store');
            Route::post('update/{id}','Admin\CategoryController@update')->name('category.update'); //update
            Route::post('update-status','Admin\CategoryController@status')->name('category.status'); //trạng thái
            Route::get('destroy/{id}','Admin\CategoryController@destroy')->name('category.destroy')->middleware(CheckLevel::class);
        });

        Route::prefix('product')->group(function () {
            Route::get('index','Admin\ProductController@index')->name('product.index');
            Route::get('add','Admin\ProductController@add')->name('product.add');
            Route::get('edit/{id}','Admin\ProductController@edit')->name('product.edit');
            Route::post('store','Admin\ProductController@store')->name('product.store');
            Route::post('update/{id}','Admin\ProductController@update')->name('product.update'); //update
            Route::post('update-status','Admin\ProductController@status')->name('product.status'); //trạng thái nb
            Route::post('update-selling','Admin\ProductController@selling')->name('product.selling'); //trạng thái sel
            Route::get('destroy/{id}','Admin\ProductController@destroy')->name('product.destroy')->middleware(CheckLevel::class);
        });
        Route::middleware(['CheckLevel'])->group(function () {
            Route::prefix('user')->group(function () {
                Route::get('index','Admin\UserController@index')->name('user.index');
                Route::get('add','Admin\UserController@add')->name('user.add');
                Route::get('edit/{id}','Admin\UserController@edit')->name('user.edit');
                Route::post('store','Admin\UserController@store')->name('user.store');
                Route::post('update/{id}','Admin\UserController@update')->name('user.update'); //update
                Route::get('destroy/{id}','Admin\UserController@destroy')->name('user.destroy'); // nổi bật
                Route::post('status','Admin\UserController@status')->name('user.status'); // nổi bật
            });
        });

        Route::prefix('order')->group(function () {
            Route::get('index','Admin\OrderController@index')->name('order.index');
            Route::get('detail','Admin\OrderController@detail')->name('order.detail');
            Route::get('destroy/{id}','Admin\OrderController@destroy')->name('order.destroy')->middleware(CheckLevel::class); // xóa
            Route::post('status','Admin\OrderController@status')->name('order.status'); // cap nhat tt
        });

        Route::middleware(['CheckLevel'])->group(function () {
            Route::prefix('voucher')->group(function () {
                Route::get('index','Admin\VoucherController@index')->name('voucher.index');
                Route::get('add','Admin\VoucherController@add')->name('voucher.add');
                Route::get('edit/{id}','Admin\VoucherController@edit')->name('voucher.edit');
                Route::get('destroy/{id}','Admin\VoucherController@destroy')->name('voucher.destroy'); // xóa
                Route::post('status','Admin\VoucherController@status')->name('voucher.status'); // cap nhat tt
                Route::post('store','Admin\VoucherController@store')->name('voucher.store'); //
                Route::post('update/{id}','Admin\VoucherController@update')->name('voucher.update')->middleware(CheckLevel::class); //
            });
        });

    });
});
