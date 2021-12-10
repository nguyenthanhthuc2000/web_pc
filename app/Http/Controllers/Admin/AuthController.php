<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
        $user = User::where('email', $request->email)->first();
        if($user){
            if($user->status == 0){
                return back()->with([
                    'error' => 'Tài khoản đã bị khóa',
                ]);
            }
        }
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


    public function getChangePass(){
        return view('admin.auth.change_password');
    }

    public function postChangePass(Request $request){

        $this->validate($request,
            [
                'old_password' => ['required'],
                'new_password' => ['required'],
                'confirm_password' => ['required'],
            ],
            [
                'old_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
                'new_password.required' => 'Vui lòng nhập mật khẩu mới',
                'confirm_password.required' => 'Vui lòng nhập mật khẩu xác nhận',
            ],
        );

        if (Hash::check($request->old_password, Auth::user()->password))
        {
            $arr = array(
                'password' => Hash::make($request->new_password)
            );
            $update = User::find(Auth::id())->update($arr);
            if($update){

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->with('success', 'Đổi mật khẩu thành công, vui lòng đăng nhập lại!');
            }
            return back()->with('error', 'Lỗi, vui lòng thử lại!');
        }
        return back()->with('error', 'Sai mật khẩu hiện tại!');

    }
}
