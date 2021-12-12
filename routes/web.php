<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('login','Admin\AuthController@login')->name('admin.login');
    Route::get('logout','Admin\AuthController@logout')->name('admin.logout');
    Route::post('post-login','Admin\AuthController@postLogin')->name('admin.post.login');

    Route::middleware('checkAdmin')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('/','Admin\AdminController@dashboard')->name('admin.dashboard');
            Route::get('change-password','Admin\AuthController@getChangePass')->name('admin.get.change.pass');
            Route::get('reset-pass/{id}','Admin\AuthController@getResetPass')->name('admin.reset.pass');
            Route::post('change-password','Admin\AuthController@postChangePass')->name('admin.post.change.pass');
            Route::get('dashboard','Admin\AdminController@dashboard')->name('admin.dashboard');

            Route::prefix('product')->group(function () {
                Route::get('index','Admin\ProductController@index')->name('product.index');
                Route::get('restore','Admin\ProductController@restoreList')->name('product.restore.list');
                Route::get('add','Admin\ProductController@add')->name('product.add');
                Route::get('edit/{id}','Admin\ProductController@edit')->name('product.edit');
                Route::post('store','Admin\ProductController@store')->name('product.store');
                Route::post('update/{id}','Admin\ProductController@update')->name('product.update'); //update
                Route::post('update-status','Admin\ProductController@status')->name('product.status'); //trạng thái nb
                Route::post('update-selling','Admin\ProductController@selling')->name('product.selling'); //trạng thái sel
                Route::get('destroy/{id}','Admin\ProductController@destroy')->name('product.destroy')->middleware(CheckLevel::class);
                Route::get('restore/{id}','Admin\ProductController@restore')->name('product.restore')->middleware(CheckLevel::class);
                Route::get('force-delete/{id}','Admin\ProductController@forceDelete')->name('product.force.delete')->middleware(CheckLevel::class);
            });

            Route::prefix('order')->group(function () {
                Route::get('index','Admin\OrderController@index')->name('order.index');
                Route::get('detail/{id}','Admin\OrderController@detail')->name('order.detail');
                Route::get('destroy/{id}','Admin\OrderController@destroy')->name('order.destroy')->middleware(CheckLevel::class); // xóa
                Route::post('status','Admin\OrderController@status')->name('order.status'); // cap nhat tt
            });

            Route::middleware(['CheckLevel'])->group(function () {
                Route::prefix('category')->group(function () {
                    Route::get('index','Admin\CategoryController@index')->name('category.index');
                    Route::get('add','Admin\CategoryController@add')->name('category.add');
                    Route::get('edit/{id}','Admin\CategoryController@edit')->name('category.edit');
                    Route::post('store','Admin\CategoryController@store')->name('category.store');
                    Route::post('update/{id}','Admin\CategoryController@update')->name('category.update'); //update
                    Route::post('update-status','Admin\CategoryController@status')->name('category.status'); //trạng thái
                    Route::get('destroy/{id}','Admin\CategoryController@destroy')->name('category.destroy');
                });

                Route::prefix('user')->group(function () {
                    Route::get('index','Admin\UserController@index')->name('user.index');
                    Route::get('add','Admin\UserController@add')->name('user.add');
                    Route::get('edit/{id}','Admin\UserController@edit')->name('user.edit');
                    Route::post('store','Admin\UserController@store')->name('user.store');
                    Route::post('update/{id}','Admin\UserController@update')->name('user.update'); //update
                    Route::get('destroy/{id}','Admin\UserController@destroy')->name('user.destroy'); // nổi bật
                    Route::post('status','Admin\UserController@status')->name('user.status'); // nổi bật
                    Route::get('history','Admin\ActivityHistoryController@index')->name('user.history');// lịch sử hoạt động của nhân viên
                    Route::get('history/{id}','Admin\ActivityHistoryController@detail')->name('user.history.detail');// lịch sử hoạt động của nhân viên
                });

                Route::prefix('voucher')->group(function () {
                    Route::get('index','Admin\VoucherController@index')->name('voucher.index');
                    Route::get('add','Admin\VoucherController@add')->name('voucher.add');
                    Route::get('edit/{id}','Admin\VoucherController@edit')->name('voucher.edit');
                    Route::get('destroy/{id}','Admin\VoucherController@destroy')->name('voucher.destroy'); // xóa
                    Route::post('status','Admin\VoucherController@status')->name('voucher.status'); // cap nhat tt
                    Route::post('store','Admin\VoucherController@store')->name('voucher.store'); //
                    Route::post('update/{id}','Admin\VoucherController@update')->name('voucher.update'); //
                });

                Route::prefix('upload-manager')->group(function () {
                    Route::post('uploads-ckeditor','Admin\UploadController@uploads_ckeditor');
                    Route::get('file/file-browser','Admin\UploadController@file_browser');
                });
            });
        });
    });
});

Route::get('/', 'customers\IndexController@index')->name('index');// Trang chủ
Route::get('/login', 'customers\AuthController@login')->name('customer.login');// Đăng nhập
Route::post('/login', 'customers\AuthController@postLogin')->name('customer.login.post'); // gửi biểu mẫu đăng nhập
Route::get('/signin', 'customers\AuthController@signin')->name('customer.signin'); //đăng ký
Route::post('/signin', 'customers\AuthController@postSignin')->name('customer.signin.post'); // gửi biểu mẫu đăng ký
Route::get('/logout', 'customers\AuthController@logout')->name('customer.logout'); // đăng xuất
Route::get('/cart', 'customers\CartController@index')->name('customer.cart'); // trang giỏ hàng
Route::get('/product-detail/{slug}', 'customers\ProductController@detail')->name('customer.product.detail'); // trang chi tiết sản phẩm
Route::post('/comment', 'customers\ProductController@comment')->name('customer.product.comment'); // gửi bình luận
Route::get('/shop', 'customers\ShopController@index')->name('customer.shop'); //trang cảu hàng -  danh sách sản phẩm
Route::get('/shop/{category}', 'customers\ShopController@getByCategory')->name('customer.shop.category'); // danh achs sản phẩm theo danh mục
Route::get('/checkout', 'customers\CheckoutController@index')->name('customer.checkout'); //trang tnanh toán
Route::get('/search', 'customers\ShopController@search')->name('customer.search'); // tìm kiếm sản phảm

Route::post('add-cart', 'customers\CartController@addCart')->name('customer.add.cart'); // thêm sản phẩm vào giỏ hàng
Route::post('del-cart', 'customers\CartController@delCart')->name('customer.del.cart'); // xóa sản phẩm trong giỏ hàng
Route::post('load-cart', 'customers\CartController@loadCart')->name('customer.load.cart'); // cập nhật lại giỏ hàng
Route::post('load-cart-total', 'customers\CartController@loadCartTotal')->name('customer.load.cart.total'); // cập nhật lại giá giỏ hàng
Route::post('update-total', 'customers\CartController@updateTotal')->name('customer.update.total');
Route::post('add-coupon', 'customers\CartController@addCoupon')->name('customer.add.coupon');
Route::post('customer-store-order', 'customers\CartController@storeOrder')->name('customer.store.order');
