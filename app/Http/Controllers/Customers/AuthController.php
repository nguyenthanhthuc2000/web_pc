<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class AuthController extends Controller
{
    public function login(){
        return view('customers.auth.login');
    }

    public function postLogin(Request $request){
        $this->validate($request,
        [
            'user_name' => 'required',
            'password' => 'required|between:3,32',
        ],
        [
            'user_name.required' => 'Trường không thể bỏ trống',
            'password.required' => 'Trường không thể bỏ trống',
            'password.between' => 'Mật khẩu tối thiểu :min kí tự và tối đa :max',
        ]
        );
        $user = User::where('email', $request->user_name)->first();
        if($user){
            if($user->status == 0){
                return back()->with([
                    'error' => 'Tài khoản đã bị khóa',
                ]);
            }
        }
        if (Auth::attempt(['email' => $request->user_name, 'password' => $request->password, 'level' => 3])) {
            return redirect()->route('index');
        }
        return back()->with([
            'error' => 'Tài khoản hoặc mật khẩu không chính xác',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

}
