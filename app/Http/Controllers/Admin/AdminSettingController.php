<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    function info()
    {
        $settings = Setting::findOrFail(1);
        return view('pages.admin.info', compact('settings'));
    }

    public function saveSettings(Request $request)
    {

        $setting = Setting::find(1);
        if (!$setting) {
            $setting = new Setting();
        }
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->phone2 = $request->phone2;
        $setting->address = $request->address;
        $setting->facebook = $request->facebook;
        $setting->youtube = $request->youtube;
        $setting->map = $request->map;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;

        $setting->update();
        toast('Cập nhật thành công', 'success');
        return back();
    }
}
