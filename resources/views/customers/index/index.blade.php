@extends('customers.layout.main_layout')
@section('title')
 Trang chủ
@endsection
@section('content')

<!-- Hero Section Begin -->
 <section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Danh mục</span>
                    </div>
                    <ul>
                        @foreach ($listCategory as $category)
                            <li><a href="{{ $category->slug }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ route('customer.search') }}">
                            <input type="text" placeholder="Nhập từ khóa" name="key" required>
                            <button type="submit" class="site-btn">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div class="slider">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('_customer/img/banner/banner-1.png') }}">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('_customer/img/banner/banner-2.png') }}">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('_customer/img/banner/banner-3.png') }}">
                        </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->



<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        @foreach ($listCategory as $category)
        @if ($category->products->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <a href=""><h2>{{ $category->name }}</h2></a>
                    </div>
                </div>
                <div class="col-lg-12 text-center pb-3">
                    <a href="" class="text-primary font-italic">Xem tất cả</a>
                </div>
            </div>
        @endif
        <div class="row featured__filter owl-carousel">
            @foreach ($category->products as $product)
                <div class="mix">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ ($product->image1 != null) ? asset('upload/products/'.$product->image1) : asset('images/noimage.png') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li>
                                    <form action="">
                                        <input type="text" value="1" class="qty_{{$product->id}}" hidden>
                                        <a type="button" class="btn-add-cart"
                                                data-id="{{$product->id}}"
                                                data-soluong="{{$product->remains}}"
                                                data-price="{{$product->price}}"
                                                data-route="{{ route('customer.add.cart') }}"
                                        >
                                            <i class="fa fa-shopping-cart "></i>
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="{{ route('customer.product.detail', $product->slug) }}">{{ $product->name }}</a></h6>
                            <h5>{{ number_format($product->price, 0,',','.') }} VNĐ</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner pb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('_customer/img/banner/banner-4.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('_customer/img/banner/banner-5.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->
</section>

@endsection
