
@if($carts != null)
    <?php
        $total = 0;
        $totalCoupon = 0;
        foreach($carts as $cart){
            $total +=  $cart['qty'] * $cart['price'];
            $totalCoupon +=  $cart['qty'] * $cart['price'];
        }

        if(Session::has('counpon_code_session')){
            $coupon = Session::get('counpon_code_session');
            $type = '';
            $giam = 0;
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
    <h5>Tổng giỏ hàng</h5>
    <ul>
        <li>Tổng hóa đơn <span>{{number_format($total, 0,',','.')}} vnđ</span></li>

        @if(Session::has('counpon_code_session'))
            <li>Giảm giá {{$type}}<span>-{{number_format($giam, 0,',','.')}} vnđ</span></li>
            <li>Tổng thanh toán <span>{{number_format($totalCoupon, 0,',','.')}} vnđ</span></li>
        @endif

        <li>Phí giao hàng <span>Miễn phí</span></li>
    </ul>
    <a href="#" class="primary-btn">THANH TOÁN</a>
@else
    <h5> Tổng giỏ hàng</h5>
    <ul>
        <li>Tổng hóa đơn <span>0</span></li>
        <li>Phí giao hàng <span>0</span></li>
    </ul>
    <a href="#" class="primary-btn">THANH TOÁN</a>
@endif
