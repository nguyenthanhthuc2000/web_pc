<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index(){
        $vouchers = Voucher::orderBy('id', 'DESC')->paginate();
        return view('admin.voucher.index', compact('vouchers'));
    }

    public function add(){
        return view('admin.voucher.add');
    }

    public function edit($id){
        $voucher = Voucher::find($id);
        return view('admin.voucher.edit', compact('voucher'));
    }


    public function store(Request $request){

        $this->validate($request,
            [
                'code' => [
                    'required',
                    "unique:App\Models\Voucher,code"
                ],
                'name' => ['required'],
            ],
            [
                'code.required' =>  'Chưa nhập nhập Code!',
                'code.unique' =>  'Code đã tồn tại!',
                'name.required' => 'Chưa nhập tên!',
            ],
        );

        $array =  array (
            'code' => $request->code,
            'name' => $request->name,
            'number' => $request->number,
            'type' => $request->type,
            'total' => $request->total,
            'used' => $request->used,
        );
        $insert = Voucher::create($array);
        if($insert){
            return redirect()->route('voucher.index')->with('success', 'Thêm thành công!');
        }
        return redirect()->route('voucher.index')->with('error', 'Thêm thất bại!');

    }
    public function destroy($id){

        $voucher = Voucher::find($id);
        if($voucher->delete($id)){
            return redirect()->route('voucher.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('voucher.index')->with('error', 'Xóa thất bại!');
    }

    public function status(Request $request){
        $voucher = Voucher::find($request->id)->update(['status' => $request->status]);
        if($voucher){
            return response()->json(['status' => 1]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'code' => [
                    'required',
                ],
                'name' => ['required'],
            ],
            [
                'code.required' =>  'Chưa nhập nhập Code!',
                'name.required' => 'Chưa nhập tên!',
            ],
        );
        $voucher = Voucher::find($id);
        if($voucher){
            $codes = Voucher::whereNotIn('id', [$id])->pluck('code')->all();
            if(in_array($request->code, $codes)){
                return redirect()->back()->withInput()->with('errorCode', 'Code đã đã tồn tại');
            }

            $array =  array (
                'code' => $request->code,
                'name' => $request->name,
                'number' => $request->number,
                'type' => $request->type,
                'total' => $request->total,
                'used' => $request->used,
            );

            $insert = $voucher->update($array);
            if($insert){
                return redirect()->route('voucher.index')->with('success', 'Cập nhật thành công!');
            }
            return redirect()->route('voucher.index')->with('error', 'Cập nhật thất bại!');
        }
        return redirect()->route('voucher.index')->with('error', 'Không tìm thấy dữ liệu!');
    }
}
