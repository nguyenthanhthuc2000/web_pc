<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use File;

class ProductController extends Controller
{
    public function index(Request $request){
        $pros = Product::orderBy('id', 'DESC')->Id($request)->paginate();
        $pros->appends(['id' => $request->id]);

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
                'slug.unique' => 'Slug sản phẩm đã tồn tại',
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
            'content' => $request->content_pro,
        ];

        if($request->file('image1')){
            //tạo tên mới cho ảnh để k bị trùng
            $image = substr(md5(microtime()),rand(0,4), 10).'.'.$request->file('image1')->getClientOriginalExtension();
            //lưu ảnh vào /upload/products
            $request->file('image1')->move('upload/products/', $image);
            $array = $array + array('image1' => $image);
        }
        if($request->file('image2')){
            $image = substr(md5(microtime()),rand(0,5), 10).'.'.$request->file('image2')->getClientOriginalExtension();
            $request->file('image2')->move('upload/products/', $image);
            $array = $array + array('image2' => $image);
        }
        if($request->file('image3')){
            $image = substr(md5(microtime()),rand(0,6), 10).'.'.$request->file('image3')->getClientOriginalExtension();
            $request->file('image3')->move('upload/products/', $image);
            $array = $array + array('image3' => $image);
        }
        if($request->file('image4')){
            $image = substr(md5(microtime()),rand(0,7), 10).'.'.$request->file('image4')->getClientOriginalExtension();
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

        $orderDetails = OrderDetail::where('product_id', $id)->get();
        if($orderDetails->count() > 0){
            return redirect()->route('product.index')->with('error', 'Sản phẩm  '.$products->name.' đã được bán '.$orderDetails->count().' lần, không thể xóa !');
        }


        if($products->delete($id)){
            return redirect()->route('product.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('product.index')->with('error', 'Xóa thất bại!');
    }

    public function edit($id){
        $pro = Product::find($id);
        $options = json_decode($pro->options);
        $cats = Category::orderBy('id', 'DESC')->get();
        return view('admin.product.edit', compact('pro', 'cats', 'options'));
    }

    public function update(Request $request, $id){
        $this->validate($request,
            [
                'name' => [
                    'required',
                ],
                'slug' => ['required'],
                'category_id' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên',
                'slug.required' =>  'Vui lòng nhập slug',
                'category_id.required' =>  'Vui lòng chọn danh mục',
            ],
        );

        //kiem tra slug
        $slugs = Product::whereNotIn('id', [$id])->pluck('slug')->all();
        if(in_array($request->slug, $slugs)){
            return redirect()->back()->withInput()->with('errorSlug', 'Slug đã đã tồn tại');
        }

        $product = Product::find($id);
        if($product) {
            $array = [
                'name' => $request->name,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'remains' => $request->remains,
                'sold' => $request->sold,
                'content' => $request->content_pro,
                'desc' => $request->desc,
                'price' => $request->price,
            ];

            if ($request->file('image1')) {
                //tạo tên mới cho ảnh để k bị trùng
                $image = substr(md5(microtime()), rand(0, 4), 10) . '.' . $request->file('image1')->getClientOriginalExtension();
                //lưu ảnh vào /upload/products
                $request->file('image1')->move('upload/products/', $image);
                $array = $array + array('image1' => $image);

                //xóa hình cũ
                if (File::exists(public_path() . "/upload/products/" . $product->image1)) {
                    File::delete(public_path() . "/upload/products/" . $product->image1);
                }
            }
            if ($request->file('image2')) {
                $image = substr(md5(microtime()), rand(0, 5), 10) . '.' . $request->file('image2')->getClientOriginalExtension();
                $request->file('image2')->move('upload/products/', $image);
                $array = $array + array('image2' => $image);

                //xóa hình cũ
                if (File::exists(public_path() . "/upload/products/" . $product->image2)) {
                    File::delete(public_path() . "/upload/products/" . $product->image2);
                }
            }
            if ($request->file('image3')) {
                $image = substr(md5(microtime()), rand(0, 6), 10) . '.' . $request->file('image3')->getClientOriginalExtension();
                $request->file('image3')->move('upload/products/', $image);
                $array = $array + array('image3' => $image);

                //xóa hình cũ
                if (File::exists(public_path() . "/upload/products/" . $product->image3)) {
                    File::delete(public_path() . "/upload/products/" . $product->image3);
                }
            }
            if ($request->file('image4')) {
                $image = substr(md5(microtime()), rand(0, 7), 6) . '.' . $request->file('image4')->getClientOriginalExtension();
                $request->file('image4')->move('upload/products/', $image);
                $array = $array + array('image4' => $image);

                //xóa hình cũ
                if (File::exists(public_path() . "/upload/products/" . $product->image4)) {
                    File::delete(public_path() . "/upload/products/" . $product->image4);
                }
            }
            if (isset($request->title_rules) && isset($request->rules)) {
                $c = json_encode(array_map(null, $request->title_rules, $request->rules));
                $array = $array + array('options' => $c);
            }

            if(!isset($request->title_rules)){
                $array = $array + array('options' => '');
            }

            $query = $product->update($array);
            if ($query) {
                return redirect()->route('product.index')->with('success', 'Cập nhật thành công!');
            }
            return redirect()->route('product.index')->with('error', 'Cập nhật thất bại!');
        }
        return redirect()->route('product.index')->with('error', 'Không tìm thấy dữ liệu!');
    }
}
