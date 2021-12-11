@extends('customers.layout.main_layout')
@section('title')
    Thanh toán
@endsection
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('_customer/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Thanh toán</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Trang chủ</a>
                            <span>Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Thông tin nhận hàng</h4>
                <form action="{{ route('customer.store.order') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Họ và tên<span>*</span></p>
                                        <input type="text" value="{{ Auth::check() == true ? Auth::user()->name : '' }}" name="name">
                                        @error('name')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add"
                                    value="{{ Auth::check() == true ? Auth::user()->address : '' }}" name="address"
                                >
                                @error('address')
                                <span class="error text-danger" >{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Điện thoại<span>*</span></p>
                                        <input value="{{ Auth::check() == true ? Auth::user()->phone : '' }}"
                                               onkeypress="return isNumberKey(event)" name="phone">
                                        @error('phone')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email" value="{{ Auth::check() == true ? Auth::user()->email : '' }}">
                                        @error('email')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span>*</span></p>
                                <input type="text" name="note" value="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <?php
                                $total = 0;
                                $totalCoupon = 0;
                                $giam = 0;
                                if(Session::has('carts')){
                                    $carts = Session::get('carts');
                                    foreach($carts as $cart){
                                        $total +=  $cart['qty'] * $cart['price'];
                                        $totalCoupon +=  $cart['qty'] * $cart['price'];
                                    }
                                }

                                if(Session::has('counpon_code_session')){
                                    $type = '';
                                    $giam = 0;
                                    $coupon = Session::get('counpon_code_session');
                                    if($coupon[0]['counpon_type'] == 1){
                                        $type = $coupon[0]['counpon_number'].'%';
                                        $giam = ($total/100) * $coupon[0]['counpon_number'];
                                        $totalCoupon = $totalCoupon - $giam;
                                    }
                                    else{
                                        $giam = $coupon[0]['counpon_number'];
                                        $type = number_format($coupon[0]['counpon_number'], 0,',','.').'vnđ';
                                        $totalCoupon = $totalCoupon - $coupon[0]['counpon_number'];
                                    }
                                }

                            ?>

                            <div class="checkout__order">
                                <h4>Hóa đơn</h4>
                                <div class="checkout__order__products">Hóa đơn <span>{{number_format($total,0,',','.')}} vnđ</span></div>
                                @if(Session::get('counpon_code_session'))
                                    <div class="checkout__order__products">Giảm giá {{$type}}<span>-{{number_format($giam, 0,',','.')}} vnđ</span></div>
                                    <div class="checkout__order__products">Tổng thanh toán<span>{{number_format($totalCoupon, 0,',','.')}} vnđ</span></div>

                                @endif
                                <div class="checkout__order__total">Phí giao hàng <span>Miễn phí</span></div>
                                <button type="submit" class="site-btn">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
