<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){
        $listCategory = Category::where('status', 1)->get();
        $listProduct = Product::where('status', 1)->paginate();
        if(isset($request->sort, $request->from, $request->to)){
            if($request->sort == 0){
                $listProduct = Product::where('status', 1)->orderBy('price', 'desc')->whereBetween('price', [$request->from, $request->to])->paginate();
            }
            $listProduct = Product::where('status', 1)->whereBetween('price', [$request->from, $request->to])->paginate();
        }
        $data = [
            'listCategory' => $listCategory,
            'listProduct' => $listProduct
        ];
        return view('customers.shop.index', $data);
    }

    public function getByCategory($category){
        $idCategory = Category::where(['status' => 1, 'slug' => $category])->first()->id;
        $listCategory = Category::where('status', 1)->get();
        $listProduct = Product::where(['status' => 1, 'category_id' => $idCategory])->paginate();
        $data = [
            'listCategory' => $listCategory,
            'listProduct' => $listProduct
        ];
        return view('customers.shop.index', $data);
    }
}
