<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $this->validate($request,
            [
                'email' => ['required'],
                'password' => ['required'],
            ],
            [
                'password.required' => 'Vui lòng nhập mật khẩu',
                'email.required' => 'Vui lòng nhập tài khoản đăng nhập ',
            ],
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }
        return back()->with([
            'error' => 'Tài khoản hoặc mật khẩu không chính xác',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
