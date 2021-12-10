<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id', 'DESC')->paginate();
        return view('admin.order.index', compact('orders'));
    }
}
