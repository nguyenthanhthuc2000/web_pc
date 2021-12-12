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
        $listProduct = Product::paginate();
        if(isset($request->sort) && $request->sort == 'up'){
            $listProduct = Product::whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->paginate(); //sắp theo giá tăng dần
            if(isset($request->selling) && $request->selling == true){
                $listProduct = Product::whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->where('selling', 1)->paginate(); // chọn các sản phẩm bán chạy
            }
            if(isset($request->feature) && $request->feature == true){
                $listProduct = Product::where('status', 1)->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->where('selling', 1)->paginate(); // chọn các sản phẩm bán chạy
            }
        }
        else if(isset($request->sort) && $request->sort == 'down'){
            $listProduct = Product::whereBetween('price', [$request->from, $request->to])->orderBy('price', 'desc')->paginate(); // sắp theo giá giảm dần
            if(isset($request->selling) && $request->selling == true){
                $listProduct = Product::whereBetween('price', [$request->from, $request->to])->orderBy('price', 'desc')->where('selling', 1)->paginate(); // chọn các sản phẩm bán chạy
            }
            if(isset($request->feature) && $request->feature == true){
                $listProduct = Product::where('status', 1)->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->where('selling', 1)->paginate(); // chọn các sản phẩm bán chạy
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
        $listProduct = Product::where(['category_id' => $idCategory])->paginate(); // danh sách sản phẩm theo danh mục
        if(isset($request->sort) && $request->sort == 'up'){
            $listProduct = Product::where(['category_id' => $idCategory])->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->paginate();
            if(isset($request->selling) &&$request->selling == true){
                $listProduct = Product::where(['category_id' => $idCategory])->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->where('selling', 1)->paginate(); // chọn các sản phẩm bán chạy
            }
            if(isset($request->feature) && $request->feature == true){
                $listProduct = Product::where('status', 1)->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->where('selling', 1)->paginate(); // chọn các sản phẩm bán chạy
            }
        }
        else if(isset($request->sort) && $request->sort == 'down'){
            $listProduct = Product::where(['category_id' => $idCategory])->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'desc')->paginate();
            if(isset($request->selling) &&$request->selling == true){
                $listProduct = Product::where(['category_id' => $idCategory])->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->where('selling', 1)->paginate(); // chọn các sản phẩm bán chạy
            }
            if(isset($request->feature) && $request->feature == true){
                $listProduct = Product::where('status', 1)->whereBetween('price', [$request->from, $request->to])->orderBy('price', 'asc')->where('selling', 1)->paginate(); // chọn các sản phẩm bán chạy
            }
        }
        $data = [
            'listCategory' => $listCategory,
            'listProduct' => $listProduct
        ];
        return view('customers.shop.index', $data);
    }

    public function search(Request $request){
        $listProduct = Product::where('name', 'LIKE', '%'.$request->key.'%')->paginate();
        $listCategory = Category::where('status', 1)->get();
        $data = [
            'listCategory' => $listCategory,
            'listProduct' => $listProduct
        ];
        return view('customers.shop.index', $data);
    }
}
