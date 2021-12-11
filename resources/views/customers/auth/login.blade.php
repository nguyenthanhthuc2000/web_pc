@extends('customers.layout.main_layout')
@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4 class="text-center">Đăng nhập</h4>
                <form action="{{ route('customer.login.post') }}" method="post">
                @include('notification')
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Email <span>*</span></p>
                                <input type="text" name="user_name"  placeholder="Email/SĐT">
                                @error('user_name')
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
                                <p>Bạn chưa có tài khoản? <a href="{{ route('customer.signin') }}" class="text-primary">Đăng ký</a></p>
                            </div>
                            <div class="checkout__input text-center">
                                <button class="btn btn-secondary">Đăng nhập</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
