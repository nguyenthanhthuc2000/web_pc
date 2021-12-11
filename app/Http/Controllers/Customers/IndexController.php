<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $listCategory = Category::where('status', 1)->get();
        $listProduct = Product::where('status', 1)->get();
        // dd($listCategory);
        $data = [
            'listCategory' => $listCategory,
            'listProduct' => $listProduct
        ];
        return view('customers.index.index', $data);
    }
}
