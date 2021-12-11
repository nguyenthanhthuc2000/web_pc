<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::orderBy('id', 'DESC')->OrderCode($request)->paginate();
        $orders->appends(['id' => $request->order_code]);
        return view('admin.order.index', compact('orders'));
    }

    public function destroy($id){
        $order = Order::find($id);
        if($order){
            if($order->delete()){
                OrderDetail::where('order_code', $id)->delete();
                return redirect()->route('order.index')->with('success', 'Xóa thành công!');
            }
        }
        return redirect()->route('order.index')->with('error', 'Xóa thất bại!');
    }

    public function detail($id){
        $order = Order::find($id);
        return view('admin.order.detail', compact('order'));
    }

}
