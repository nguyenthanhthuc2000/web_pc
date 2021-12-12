
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ route('index') }}"><img src="{{ asset('_customer/img/logo.png') }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="/_customer/js/jquery-3.3.1.min.js"></script>
    <script src="/_customer/js/bootstrap.min.js"></script>
<script src="/_customer/js/bootstrap.bundle.js"></script>
    <script src="/_customer/js/jquery.nice-select.min.js"></script>
    <script src="/_customer/js/jquery-ui.min.js"></script>
    <script src="/_customer/js/jquery.slicknav.js"></script>
    <script src="/_customer/js/mixitup.min.js"></script>
    <script src="/_customer/js/owl.carousel.min.js"></script>
    <script src="/_customer/js/main.js"></script>
    <script src="/vendor/sweetalert2.min.js"></script>

    <script>

        loadCart();
        loadCartTotal();

        function loadCart(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
             $.ajax({
                url: '/load-cart',
                method:'POST',
                success:function(data){
                    $('#box-cart').html(data);
                }
            })
        }
        function loadCartTotal(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
             $.ajax({
                url: '/load-cart-total',
                method:'POST',
                success:function(data){
                    $('.shoping__checkout').html(data);
                }
            })
        }

        $(document).on("change", ".pro-cart-qty", function(){
            var qty = $(this).val();
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
             $.ajax({
                url: '/update-total',
                method:'POST',
                data:{id:id, qty:qty},
                success:function(data){
                    if(data.status = 200){
                        loadCart();
                        loadCartTotal();
                    }
                }
            })
        })

        $('.btn-add-coupon').click(function(){
            var code = $('#code').val();
            if(code != ''){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                 $.ajax({
                    url: '/add-coupon',
                    method:'POST',
                    data:{code:code},
                    success:function(data){
                        if(data.status = 200){
                            loadCart();
                            loadCartTotal();
                            Swal.fire(
                                data.message,
                              'Cảm ơn bạn!',
                              'success'
                            )
                        }
                        else{
                            Swal.fire(
                              data.message,
                              'Kiểm tra lại mã giảm giá của bạn!',
                              'error'
                            )
                        }
                    }
                })
            }
            else{
                Swal.fire(
                  'Lỗi',
                  'Vui lòng nhập mã giảm giá!',
                  'error'
                )
            }

        })

        $(document).on("click",".icon_close",function() {
            var id = $(this).data('id');
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
             $.ajax({
                url: '/del-cart',
                method:'POST',
                data:{id:id},
                success:function(data){
                $('.count-cart').text(data.count);
                  loadCart();
                    loadCartTotal();
                }
            })
        });


        $('.btn-add-cart').click(function(){

			var id = $(this).data('id');
            var route = $(this).data('route');
            var qty = $('.qty_' +id).val();
			if( $(this).data('soluong') == '0'){
    			Swal.fire(
				  'Sản phẩm đã hết hàng!',
				  'Vui lòng quay lại sau! Hoặc LH shop để được tư vấn!',
				  'error'
				)
			}
			else if($(this).data('price') == '0'){
    			Swal.fire(
				  'Liên hệ chủ shop!',
				  'Liên hệ chủ CSKH để được báo giá!',
				  'error'
				)
			}
			else{
			    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
				 $.ajax({
                	url: route,
                	method:'POST',
                	data:{id:id,qty:qty},
                	success:function(data){
                        x = data.count;
                		if(x != null){
                            $('.count-cart').text(x);
                            loadCart();
                            loadCartTotal();
                			Swal.fire(
							  'Thêm giỏ hàng thành công!',
							  'Tiếp tục mua hàng!',
							  'success'
							)
                		}else{
                			Swal.fire(
							  'Thất bại!',
							  'Thử lại sau!',
							  'error'
							)
                		}
                	}
                })
			}
        })
    </script>
    @method('script')
