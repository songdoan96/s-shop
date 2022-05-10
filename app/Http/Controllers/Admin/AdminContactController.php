<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class AdminContactController extends Controller
{
    function contact()
    {
        $contacts = Contact::paginate(15);
        return view('pages.admin.contact', compact('contacts'));
    }
}
