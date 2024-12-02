<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function postRegister(Request $request) {
        // try {
            $data = $request->validate([
                'fullname'          => 'required|string|max:255',
                'username'          => 'required|string|unique:users,username|min:5',
                'email'             => 'required|string|unique:users,email|email',
                'password'          => 'required|min:6',
                'password_confirm'  => 'required|same:password',
                
                // 'avatar'    => 'nullable|image|max:2048',
            ],[
                'fullname.required' => 'Vui Lòng Nhập Họ Tên',
                'fullname.string' => 'Họ Tên Không Đúng Định Dạng',
                'fullname.max' => 'Họ Tên Nhiều Nhất 255 Ký Tự',
                'username.required' => 'Vui Lòng Nhập Tên Đăng Nhập',
                'username.string' => 'Tên Đăng Nhập Không Đúng Định Dạng',
                'username.min' => 'Tên Đăng Nhập Tối Thiểu 5 Ký Tự',
                'username.unique' => 'Tên Đăng Nhập Đã Tồn Tại',
                'email.required' => 'Vui Lòng Nhập Email',
                'email.string' => 'Email Không Đúng Định Dạng',
                'email.email' => 'Email Không Đúng Định Dạng',
                'email.unique' => 'Email Đã Tồn Tại',
                'password.required' => 'Vui Lòng Nhập Mật Khẩu',
                'password.min' => 'Mật Khẩu Tối Thiểu 6 Ký Tự',
                'password_confirm.same' => 'Mật khẩu không khớp',
                'password_confirm.required' => 'Mật khẩu không khớp',
            ]);

            // dd($data);
    
            Debugbar::info($data);
    
            User::query()->create($data);

            Debugbar::success('Đăng Ký Thành Công');
    
            return redirect()
                    ->route('login')
                    ->with('success', 'Đăng Ký Thành Công');
        // } catch (Exception $e) {
        //     Debugbar::error($e->getMessage());

        //     return back()
        //             ->with('error', 'Đăng Ký Thất Bại')
        //             ->withInput();
        // }
        
    }

    public function login()
    {
        Auth::logout();
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        // try {
            $data = $request->validate([
                'email'     => 'required|string|email',
                'password'  => 'required|string|min:6',
            ], [
                'email.required'    => 'Vui Lòng Nhập Email',
                'email.email'       => 'Email Không Đúng Định Dạng',
                'password.required' => 'Vui Lòng Nhập Mật Khẩu',
                'password.min'      => 'Mật Khẩu Ít Nhất 6 Ký Tự',
            ]);

            

            Debugbar::info($data);

            if (Auth::attempt($data)) {
                if (Auth::user()->role == 'admin') {
                    return redirect()
                            ->route('admin.dashboard')
                            ->with('success', 'Đăng Nhập Thành Công Admin');
                } else if (Auth::user()->active == 0) {
                    return redirect()
                            ->route('login')
                            ->with('error', 'Tài Khoản Của Bạn Đã Bị Khoá');
                } else {
                    return redirect()
                            ->route('dashboard')
                            ->with('success', 'Đăng Nhập Thành Công User');
                }
            }

            return back()
                    ->with('error', 'Email Hoặc Mật Khẩu Không Đúng');

        // } catch (Exception $e) {
        //     Debugbar::error($e->getMessage());

        //     return back()
        //             ->with('error', 'Đăng Nhập Thất Bại');
        // }
    }    

    public function logout() {
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()
                ->route('login')
                ->with('success', 'Đăng Xuất Thành Công');
    }

}
