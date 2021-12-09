<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Category;
use File;

class ProductController extends Controller
{
    public function index(){
        $pros = Product::orderBy('id', 'DESC')->paginate();
        return view('admin.product.index', compact('pros'));
    }

    public function add(){
        $cats = Category::orderBy('id', 'DESC')->get();
        return view('admin.product.add', compact('cats'));
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'name' => [
                    'required',
                    "unique:App\Models\Product,slug"
                ],
                'slug' => ['required'],
                'category_id' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên',
                'slug.unique' => 'Tên sản phẩm đã tồn tại',
                'slug.required' =>  'Vui lòng nhập slug',
                'category_id.required' =>  'Vui lòng chọn danh mục',
            ],
        );

        $array = [
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'remains' => $request->remains,
            'sold' => $request->sold,
            'desc' => $request->desc,
            'price' => $request->price,
        ];

        if($request->file('image1')){
            //tạo tên mới cho ảnh để k bị trùng
            $image = substr(md5(microtime()),rand(0,4), 6).'-'.$request->file('image1')->getClientOriginalName();
            //lưu ảnh vào /upload/products
            $request->file('image1')->move('upload/products/', $image);
            $array = $array + array('image1' => $image);
        }
        if($request->file('image2')){
            $image = substr(md5(microtime()),rand(0,5), 6).'-'.$request->file('image2')->getClientOriginalName();
            $request->file('image2')->move('upload/products/', $image);
            $array = $array + array('image2' => $image);
        }
        if($request->file('image3')){
            $image = substr(md5(microtime()),rand(0,6), 6).'-'.$request->file('image3')->getClientOriginalName();
            $request->file('image3')->move('upload/products/', $image);
            $array = $array + array('image3' => $image);
        }
        if($request->file('image4')){
            $image = substr(md5(microtime()),rand(0,7), 6).'-'.$request->file('image4')->getClientOriginalName();
            $request->file('image4')->move('upload/products/', $image);
            $array = $array + array('image4' => $image);
        }
        if( isset($request->title_rules)  && isset($request->rules)){
            $c = json_encode(array_map(null, $request->title_rules, $request->rules));
            $array = $array + array('options' => $c);
        }
        $query = Product::create($array);
        if($query){
            return redirect()->route('product.index')->with('success', 'Thêm thành công!');
        }
        return redirect()->route('product.index')->with('error', 'Thêm thất bại!');

    }

    public function status(Request $request){
        $category = Product::find($request->id)->update(['status' => $request->status]);
    }

    public function selling(Request $request){
        $category = Product::find($request->id)->update(['selling' => $request->selling]);
    }
    public function destroy($id){

        $products = Product::find($id);
        if($products->delete($id)){
            return redirect()->route('product.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('product.index')->with('error', 'Xóa thất bại!');
    }

    public function edit(){
        return view('admin.product.edit');
    }
}
