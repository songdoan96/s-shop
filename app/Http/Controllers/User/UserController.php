<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function changePassword()
    {
        return view('pages.user.password.change');
    }

    public function storePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ], [
            'required' => 'Vui lòng nhập trường này',
            'confirm_password.same' => 'Mật khẩu chưa khớp',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Hash::check($request->current_password, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->password)]);
            Alert::success('', 'Đổi mật khẩu thành công.');
        } else {
            Alert::warning('', 'Mật khẩu cũ không đúng');
        }
        return back();
    }
}
