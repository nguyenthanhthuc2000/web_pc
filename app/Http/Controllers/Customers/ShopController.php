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
            if($request->sort == 'up'){
                $listProduct = Product::where('status', 1)->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->paginate();
            }
            else if($request->sort == 'down'){
                $listProduct = Product::where('status', 1)->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'desc')->paginate();
            }
        }
        $data = [
            'listCategory' => $listCategory,
            'listProduct' => $listProduct
        ];
        return view('customers.shop.index', $data);
    }

    public function getByCategory(Request $request, $category){
        $idCategory = Category::where(['status' => 1, 'slug' => $category])->first()->id;
        $listCategory = Category::where('status', 1)->get();
        $listProduct = Product::where(['status' => 1, 'category_id' => $idCategory])->paginate();
        if(isset($request->sort, $request->from, $request->to)){
            if($request->sort == 'up'){
                $listProduct = Product::where(['status' => 1, 'category_id' => $idCategory])->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->paginate();
            }
            else if($request->sort == 'down'){
                $listProduct = Product::where(['status' => 1, 'category_id' => $idCategory])->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'desc')->paginate();
            }
        }
        $data = [
            'listCategory' => $listCategory,
            'listProduct' => $listProduct
        ];
        return view('customers.shop.index', $data);
    }
}
