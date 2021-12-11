<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Voucher;

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
                        'session_id' => $session_id,
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
                    'session_id' => $session_id,
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
                'session_id' => $session_id,
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
}
