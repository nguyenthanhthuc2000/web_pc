@extends('customers.layout.main_layout')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('_customer/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $detailsProduct->name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Trang chủ</a>
                            <a href="{{ route('index')  }}">{{ $detailsProduct->category->name }}</a>
                            <span>{{ $detailsProduct->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ ($detailsProduct->image1 != null) ? asset('upload/products/'.$detailsProduct->image1) : asset('images/noimage.png') }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ asset('upload/products/'.$detailsProduct->image1) }}"
                                src="{{ asset('upload/products/'.$detailsProduct->image1) }}" alt="">
                            @if ($detailsProduct->image2)
                                <img data-imgbigurl="{{ asset('upload/products/'.$detailsProduct->image2) }}"
                                    src="{{ asset('upload/products/'.$detailsProduct->image2) }}" alt="">
                            @endif
                            @if ($detailsProduct->image3)
                                <img data-imgbigurl="{{ asset('upload/products/'.$detailsProduct->image3) }}"
                                    src="{{ asset('upload/products/'.$detailsProduct->image3) }}" alt="">
                            @endif
                            @if ($detailsProduct->image4)
                                <img data-imgbigurl="{{ asset('upload/products/'.$detailsProduct->image4) }}"
                                    src="{{ asset('upload/products/'.$detailsProduct->image4) }}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $detailsProduct->name }}</h3>
                        <div class="product__details__price">{{ number_format($detailsProduct->price, 0,',','.') }} VNĐ</div>
                        <p>{{ $detailsProduct->desc }}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" class="qty_{{$detailsProduct->id}}">
                                </div>
                            </div>
                        </div>
                        <button  class="primary-btn btn-add-cart"
                                data-id="{{$detailsProduct->id}}"
                                data-soluong="{{$detailsProduct->remains}}"
                                data-price="{{$detailsProduct->price}}"
                                data-route="{{ route('customer.add.cart') }}"
                            >THÊM VÀO GIỎ HÀNG
                        </button>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Chi tiết sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Thông tin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Bình luận <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Chi tiết sản phẩm</h6>
                                    <table class="table">
                                        <tbody class="text-center">
                                            @if(json_decode($detailsProduct->options) != null)
                                                @foreach (json_decode($detailsProduct->options) as $option)
                                                    <tr>
                                                        <th>{{ $option[0] }}</th>
                                                        <td>{{ $option[1] }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th colspan="2">Không có dữ liệu</th>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Thông tin sản phẩm</h6></h6>
                                    <p>{!! $detailsProduct->content !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Bình luận</h6>
                                    <div class="coment-bottom bg-white p-2 px-4">
                                        <form action="{{ route('customer.product.comment') }}" method="post">
                                            <input type="hidden" value="{{ $detailsProduct->id }}"name="product_id">
                                            @csrf
                                            <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                                                <input type="text" class="form-control mr-3" placeholder="Nội dung bình luận" name="comment">
                                                <button class="btn btn-primary" type="sunmit">Gửi</button>
                                            </div>
                                            @error('comment')
                                                <i class="error text-danger">{{ $message }}</i>
                                            @enderror
                                        </form>
                                        @if ($comments->count() > 0)
                                            @foreach ($comments as $comment)
                                                <div class="commented-section mt-2">
                                                    {{-- <div class="d-flex flex-row align-items-center commented-user">
                                                        <h5 class="mr-2 font-weight-bold">{{ $comment->name }}:</h5>
                                                    </div> --}}
                                                    <div class="comment-text-sm pl-2">
                                                        <span>{{ $comment->comment }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center font-weight-bold font-italic">
                                                Chưa có đánh giá cho sản phẩm này
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProduct as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('upload/products/'.$detailsProduct->image1) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $product->name }}</a></h6>
                                <h5>{{ number_format($product->price, 0,',','.') }} VNĐ</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection
