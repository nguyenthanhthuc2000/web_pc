<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\OrderDetail;
use App\Models\Order;
use Mail;
use Auth;

class CartController extends Controller
{
    public function index(){
        return view('customers.cart.index');
    }

    public function addCoupon(Request $request){
        if($request->code != null){
            $counpon = Voucher::where('code', $request->code)->where('status', 1)->first();
            if($counpon == null){
                return Response()->json(['status' => 403, 'message' => 'Mã giảm giá không tồn tại!']);
            }
            else{

                if($counpon->total > 0) {
                    $counpon_code_session[] = array(
                        'counpon_id' =>  $counpon->id,
                        'counpon_code' =>  $counpon->code,
                        'counpon_type' =>  $counpon->type,
                        'counpon_number' =>  $counpon->number,
                    );
                    Session::put('counpon_code_session', $counpon_code_session);
                    return Response()->json(['status' => 200, 'message' => 'Dùng mã giảm giá thành công!']);
                }
                else{
                    return Response()->json(['status' => 403, 'message' => 'Mã giảm giá hết lượt dùng!']);
                }

            }
        }

    }

    public function loadCart(Request $request){
        $carts = null;
        if(Session::has('carts')){
            $carts = Session::get('carts');
        }
        return view('customers.cart.view_cart', compact('carts'));
    }

    public function updateTotal(Request $request){
        $carts = Session::get('carts');
        if($carts == true) {
            foreach ($carts as $key => $cart) {
                if ($cart['id'] == $request->id) {
                    $carts[$key]['qty'] = $request->qty;
                }
            }
            Session::put('carts',$carts);
            return Response()->json(['status' => 200]);
        }
        return Response()->json(['status' => 403]);

    }

    public function loadCartTotal(Request $request){
        $carts = null;
        if(Session::has('carts')){
            $carts = Session::get('carts');
        }
        return view('customers.cart.view_cart_total', compact('carts'));
    }

    public function delCart(Request $request){

        $carts = Session::get('carts');
        if($carts == true){
            foreach($carts as $key => $cart) {
                if($request->id == $cart['id']){
                    unset($carts[$key]);
                }
            }
            Session::put('carts',$carts);
            return Response()->json(['status' => 200]);
        }
        else{
            Response()->json(['status' => 403]);
        }
    }

    public function addCart(Request $request){

        $data = $request->all();
        $product = Product::find($data['id']);
        $session_id = substr(md5(microtime()),rand(10,25), 5);
        $carts = Session::get('carts');
        if($carts == true){
            $i = 0;
            foreach ($carts as $key => $cart) {
                if($cart['id'] == $product->id){
                    $i++;
                    $carts[$key] = array(
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'qty' => $data['qty'] + $cart['qty'],
                        'image' => $product->image1,
                    );
                    Session::put('carts',$carts);
                }
            }
            if($i == 0){
                $carts[] = array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'qty' => $data['qty'],
                    'image' => $product->image1,
                );
                Session::put('carts',$carts);
            }
        }
        else{
            $carts[] = array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $data['qty'],
                'image' => $product->image1,
            );
            Session::put('carts',$carts);
        }

        Session::put('carts',$carts);
        return response()->json(['count' => count($carts)]);

    }

    public function storeOrder(Request $request){
        if(Auth::check()){
            $this->validate($request,
                [
                    'name' => ['required'],
                    'email' => ['required'],
                    'address' => ['required'],
                    'phone' => ['required', 'max:12', 'min:10'],
                ],
                [
                    'name.required' => 'Vui lòng nhập tên',
                    'email.required' =>  'Vui lòng nhập địa chỉ email',
                    'address.required' =>  'Vui lòng nhập địa chỉ nhận hàng',
                    'phone.required' =>  'Vui lòng nhập số điện thoại',
                    'phone.max' =>  'Sai định dạng',
                    'phone.min' =>  'Sai định dạng',
                ],
            );

            if(Session::get('carts')){
                $order_code = 'MHD'.substr(md5(microtime()),rand(0,10),10);

                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $data = $request->all();
                $Order = new Order();
                $Order->order_code = $order_code;
                $Order->name = $data['name'];
                $Order->address = $data['address'];
                $Order->phone = $data['phone'];
                $Order->email = $data['email'];
                $Order->note = $data['note'];
                $Order->total = Session::get('totalSession');
                $Order->save();

                $content = '';
                $total = Session::get('total');
                $giam = 0;
                if(Session::has('giam')){
                    $giam = Session::get('giam');
                }


                foreach (Session::get('carts') as $key => $cart) {
                    $order_detail = new OrderDetail();
                    $product = Product::find($cart['id']);
                    $order_detail->order_code = $order_code;
                    $order_detail->product_id = $cart['id'];
                    $order_detail->quantily = $cart['qty'];
                    if(Session::has('counpon_code_session')){
                        $counpon = Session::get('counpon_code_session');
                        $order_detail->voucher_id = $counpon[0]['counpon_id'];

                    }
                    $content .= '<p>Mã: '.$cart['id'].' --- '.$product->name. ' --- giá: '.number_format($cart['price'], 0,',','.').' vnđ --- số lượng:'.$cart['qty'].'</p>';

                    $order_detail->save();
                }

                if(Session::has('counpon_code_session')){
                    $voucher = Voucher::find($counpon[0]['counpon_id']);
                    $array = [
                        'total' => $voucher->total - 1,
                        'used' => $voucher->used + 1
                    ];
                    $voucher->update($array);
                }

                $title = 'Xác nhận đơn hàng của bạn từ MIENTAY.COM';
                $email = $data['email'];

                Mail::send('customers.checkout.mail',
                    array(
                        'content' => $content,
                        'total' => $total,
                        'giam' => $giam,
                        'name' => $data['name'],
                        'address' => $data['address']
                    ),
                    function ($message) use ($email, $title) {
                        $message->to($email, $title)->subject($title);
                    });

                Session::forget('counpon_code_session');
                Session::forget('carts');
                Session::forget('total');
                Session::forget('giam');
                Session::forget('totalSession');
                return  redirect()->route('customer.cart')->with('success', 'Đặt hàng thành công, chúng tôi sẽ liên hệ với bạn trong khoảng thời gian sớm nhất!');
            }
            return redirect()->route('customer.cart')->with('error', 'Lỗi, vui lòng thử lại!');
        }
        return redirect()->route('customer.login');
    }
}
