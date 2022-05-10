<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    function users()
    {
        $users = User::all();
        return view('pages.admin.user', compact('users'));
    }

    function userEditRole($id)
    {
        $user = User::findOrFail($id);
        $user->role = $user->role == 'admin' ? 'user' : 'admin';
        $user->update();
        toast('Cập nhật thành công', 'success');
        return redirect()->route('admin.users');
    }
}
