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

    public function edit($id){

        $cat = Category::find($id);
        return view('admin.category.edit', compact('cat'));
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

    public function update(Request $request, $id){

        $cat = Category::find($id);

        $this->validate($request,
            [
                'slug' => [
                    'required',
                ],
                'name' => ['required'],
            ],
            [
                'slug.required' =>  'Chưa nhập nhập slug!',
                'name.required' => 'Chưa nhập tên danh mục!',
            ],
        );

        //kiem tra xem nam có ton tai chưa
        $slugs = Category::whereNotIn('id', [$id])->pluck('slug')->all();
        if(in_array($request->slug, $slugs)){
            return redirect()->back()->withInput()->with('errorSlug', 'Slug đã đã tồn tại');
        }

        $array =  array (
            'status' => $request->status,
            'name' => $request->name,
            'slug' => $request->slug,
        );
        if($request->file('image')){
            $image = substr(md5(microtime()),rand(0,9), 6).'-'.$request->file('image')->getClientOriginalName();

            //xóa hình cũ
            if(File::exists(public_path()."/upload/category/".$cat->image)){
                File::delete(public_path()."/upload/category/".$cat->image);
            }
            $request->file('image')->move('upload/category/', $image);

            $array = $array + array('image' => $image);
        }

        $cat->update($array);
        if($cat){
            return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
        }
        return redirect()->route('category.index')->with('error', 'Cập nhật thất bại!');
    }

    public function destroy($id){

        $products = Product::where('category_id', $id)->get();
        $category = Category::find($id);
        if($products->count() > 0){
            return redirect()->route('category.index')
                ->with('error', 'Tồn tại '.$products->count().' sản phẩm thuộc danh mục '.$category->name.', không thể xóa !');
        }
        if($category->delete($id)){
            return redirect()->route('category.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('category.index')->with('error', 'Xóa thất bại!');
    }

    public function status(Request $request){
        $category = Category::find($request->id)->update(['status' => $request->status]);
    }
}

