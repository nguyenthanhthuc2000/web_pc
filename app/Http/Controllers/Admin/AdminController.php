<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $orders = Order::orderBy('id', 'DESC')->paginate();

        return view('admin.order.index', compact('orders'));
    }
}
