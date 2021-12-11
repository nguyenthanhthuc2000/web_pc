<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

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
        $orderDetail = OrderDetail::where('order_code', $order->order_code)->get();
        return view('admin.order.detail', compact('order', 'orderDetail'));
    }

    public function status(Request $request){
        $order = Order::find($request->id);
        $order->status = $request->status;
        if($order->save()){
            $orderDetail = OrderDetail::where('order_code', $order->order_code)->get();

            if($request->status == 1 || $request->status == 2){
                if($order->check_status == 0){
                    foreach ($orderDetail as $pro){
                        $product = Product::find($pro->product_id);
                        $array = [
                            'sold' => $product->sold + $pro->quantily,
                            'remains' => $product->remains - $pro->quantily,
                        ];
                        $order->update(['check_status' => 1]);
                        $product->update($array);
                    }

                }

//                $arrayHistory = [
//                    'user_id' => Auth::id(),
//                    'action' => 'Cập nhật trạng thái hóa đơn ID: '.$order->order_code.' thành: '.$request->txt_status
//                ];
//                $this->activityHistoryRepo->create($arrayHistory);
            }

            if($request->status ==  3 || $request->status ==  0){
                if($order->check_status == 1) {
                    foreach ($orderDetail as $pro) {
                        $product = Product::find($pro->product_id);
                        $array = [
                            'sold' => $product->sold - $pro->quantily,
                            'remains' => $product->remains + $pro->quantily,
                        ];
                        $product->update($array);
                        $order->update(['check_status' => 0]);
                    }
                }
//                $arrayHistory = [
//                    'user_id' => Auth::id(),
//                    'action' => 'Cập nhật trạng thái hóa đơn ID: '.$order->order_code.' thành: '.$request->txt_status
//                ];
//                $this->activityHistoryRepo->create($arrayHistory);
            }
            return 1;
        }
        return 0;
    }

}
