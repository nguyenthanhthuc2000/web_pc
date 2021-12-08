<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use App\Models\Product;
use File;

class CategoryController extends Controller
{
    public function index(){
        $cats = Category::orderBy('id', 'DESC')->paginate();
        return view('admin.category.index', compact('cats'));
    }

    public function add(){
        return view('admin.category.add');
    }

    public function edit(){
        return view('admin.category.edit');
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'slug' => [
                    'required',
                    "unique:App\Models\Category,slug" // check xem slug đã tồn tại chưa
                ],
                'name' => ['required'],
            ],
            [
                'slug.required' =>  'Chưa nhập nhập slug!',
                'slug.unique' =>  'Slug đã tồn tại!',
                'name.required' => 'Chưa nhập tên danh mục!',
            ],
        );
        $array =  array (
            'status' => $request->status,
            'name' => $request->name,
            'slug' => $request->slug,
        );
        if($request->file('image')){
            $image = substr(md5(microtime()),rand(0,9), 6).'-'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move('upload/category/', $image);
            $array = $array + array('image' => $image);
        }

        $insert = Category::create($array);
        if($insert){
            return redirect()->route('category.index')->with('success', 'Thêm thành công!');
        }
        return redirect()->route('category.index')->with('error', 'Thêm thất bại!');
    }

}
