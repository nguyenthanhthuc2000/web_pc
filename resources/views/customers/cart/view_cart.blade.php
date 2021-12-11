
@if($carts != null)
    @foreach($carts as $cart)
        <tr>
            <td class="shoping__cart__item">

                @if($cart['image'] != null)
                    <img style="    width: 100px;height: 100px;object-fit: cover;"
                         src="{{ asset('upload/products/'.$cart['image']) }}" alt=""
                    >
                @else
                    <img style="    width: 100px;height: 100px;object-fit: cover;"
                         src="{{asset('images/noimage.png')  }}"  class="img-admin" >
                @endif
                <h5>{{$cart['name']}}</h5>
            </td>
            <td class="shoping__cart__price">
                {{number_format($cart['price'], 0,',','.')}}
            </td>
            <td class="shoping__cart__quantity">
                <div class="quantity">
                    <div class="pro-qty">
                        <input type="number" value="{{$cart['qty']}}"
                               data-id="{{$cart['id']}}"
                               onkeypress="return isNumberKey(event)" class="pro-cart-qty" min="1"
                        >
                    </div>
                </div>
            </td>
            <td class="shoping__cart__total">
                <?php
                    $subtotal = $cart['price'] * $cart['qty'];
                    echo number_format($subtotal, 0,',','.');
                ?>
            </td>
            <td class="shoping__cart__item__close">
                <span class="icon_close" data-id="{{$cart['id']}}"></span>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5">
           Không có dữ liệu
        </td>
    </tr>
@endif
