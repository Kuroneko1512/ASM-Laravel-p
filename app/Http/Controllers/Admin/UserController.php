<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function ban($id)
    {

        User::query()
            ->where('id', $id)
            ->update(['active' => 0]);
        return back();
    }
    public function unban($id)
    {
        User::query()
            ->where('id', $id)
            ->update(['active' => 1]);
        return back();
    }

    public function toggleUserStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        $status = $user->active ? 'Kích hoạt' : 'Cấm';
        return back()->with('success', "Đã {$status} tài khoản của {$user->fullname}");
    }
}
