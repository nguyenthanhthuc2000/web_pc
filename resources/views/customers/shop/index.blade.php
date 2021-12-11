@extends('customers.layout.main_layout')
@section('title')
    Cửa hàng
@endsection
@section('content')
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('_customer/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Cửa hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Trang chủ</a>
                            <span>Của hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục</h4>
                            <ul>
                                @foreach ($listCategory as $category)
                                    <li><a href="{{ route('customer.shop.category', $category->slug) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <form action="{{ url()->current() }}" method="get">
                            <div class="sidebar__item">
                                <h4>Giá</h4>
                                <div class="price-range-wrap">
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <input type="number" id="minamount" min="0" placeholder="Giá thấp nhất" name="from" value="{{ (request()->get('from')) ? request()->get('from') : 0 }}">
                                            <input type="number" id="maxamount" min="0" placeholder="Giá cao nhất" name="to" value="{{ (request()->get('to')) ? request()->get('to') : 0 }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar__item">
                                <div class="filter__sort">
                                    <span>Sắp xếp</span>
                                    <select name="sort">
                                        <option value="up" {{ (request()->get('sort') == 'up') ? 'selected' : '' }}>Tăng dần</option>
                                        <option value="down" {{ (request()->get('sort') == 'down') ? 'selected' : '' }}>Giảm dần</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sidebar__item text-right">
                                <button class="btn btn-success" type="sunmit">Lọc</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-12">
                                <div class="filter__found">
                                    <h6>Tìm tháy <span>{{ $listProduct->count() }}</span>sản phẩm</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($listProduct as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ ($product->image1 != null) ? asset('upload/products/'.$product->image1) : asset('images/noimage.png') }}">
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="{{ route('customer.product.detail', $product->slug) }}">{{ $product->name }}</a></h6>
                                        <h5>{{ number_format($product->price, 0,',','.') }} VNĐ</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="product__pagination">
                        {{ $listProduct->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection