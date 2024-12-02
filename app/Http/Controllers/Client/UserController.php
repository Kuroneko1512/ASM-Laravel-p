<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        Debugbar::info($user);
        return view('client.user.index', compact('user'));
    }


    public function editProfile()
    {
        $user = auth()->user();
        Debugbar::info($user);
        return view('client.user.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        try {
            $data = $request->validate([
                'fullname'  => 'required|string|max:255',
                'username'  => 'required|string|min:5,|unique:users,username,' . auth()->id(),
                'email'     => 'required|email|unique:users,email,' . auth()->id(),
                'avatar'    => 'nullable|image|max:2048',
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
                'avatar.image'   => 'Ảnh không đúng định dạng',
                'avatar.max'   => 'Ảnh không được quá 2MB',

            ]);

            $user = auth()->user();

            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    Storage::delete($user->avatar);
                }                

                $data['avatar'] = $request->file('avatar')->store('avatars');
            }

            User::query()->find($user->id)->update($data);
            return back()
                    ->with('success', 'Cập nhật thông tin thành công');

        } catch (Exception $e) {
            Debugbar::error($e->getMessage());
            return back()
                ->with('error', 'Something went wrong');
        }
    }

    public function changePasswordForm()
    {
        return view('client.user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ],[
            'current_password.required' => 'Vui Lòng Nhập Mật Khẩu',
            'new_password.required' => 'Vui Lòng Nhập Mật Khẩu Mới',
            'new_password.min' => 'Mật Khẩu Mới Tối Thiểu 6 Ký Tự',
            'new_password_confirmation.required' => 'Vui Lòng Xác Nhận Mật Khẩu Mới',
            'new_password_confirmation.same' => 'Mật khẩu không khớp',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        $user->password = Hash::make($request->new_password);
        
        User::query()->find(($user->id))->update([
            'password' => $user->password,
        ]);

        return redirect()
                ->route('dashboard')
                ->with('success', 'Mật khẩu đã được thay đổi.');
    }
}
