<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($slug){
        $id = Product::where('slug', $slug)->first()->id;
        $detailsProduct = Product::find($id);
        return view('customers.product.product_detail', compact('detailsProduct'));
    }
}
