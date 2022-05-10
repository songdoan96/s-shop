<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    function contact()
    {
        DB::table('settings')->where('id',1)->get();
        $map = Setting::findOrFail(1)->map;
        return view('pages.contact', compact('map'));
    }

    public function sendMessage(Request $request)
    {

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->comment = $request->comment;
        $contact->save();
        toast('Cảm ơn phản hồi của bạn', 'success', 'top-end');
        return back();
    }
}
