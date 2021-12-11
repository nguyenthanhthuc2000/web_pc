@extends('customers.layout.main_layout')
@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4 class="text-center">Đăng ký</h4>
                <form action="{{ route('customer.signin.post') }}" method="post">
                @include('notification')
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Họ tên <span>*</span></p>
                                <input type="text" name="name"  placeholder="Họ tên">
                                @error('name')
                                    <i class="error text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Email <span>*</span></p>
                                <input type="text" name="email"  placeholder="Email">
                                @error('email')
                                    <i class="error text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Số điện thoại <span>*</span></p>
                                <input type="text" name="phone"  placeholder="Số điện thoại">
                                @error('phone')
                                    <i class="error text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Mật khẩu <span>*</span></p>
                                <input type="password" placeholder="Mật khẩu" class="checkout__input__add" name="password">
                                @error('password')
                                    <i class="error text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Xác nhận mật khẩu <span>*</span></p>
                                <input type="password" placeholder="Xác nhận mật khẩu" class="checkout__input__add" name="confirm_password">
                                @error('confirm_password')
                                    <i class="error text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ <span>*</span></p>
                                <input type="text" placeholder="Địa chỉ" class="checkout__input__add" name="address">
                                @error('address')
                                    <i class="error text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Quay lại <a href="{{ route('customer.login') }}" class="text-primary">Đăng nhập</a></p>
                            </div>
                            <div class="checkout__input text-center">
                                <button class="btn btn-secondary">Đăng ký</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
