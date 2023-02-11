<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class PageController extends Controller
{
    public function contact()
    {
        return view('android.page.contact');
    }

    public function contactform(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'details' => 'required'
        ],[
            'name.required' => 'Name is required',
            'mobile.required' => 'Mobile is required',
            'email.required' => 'Email is required',
            'details.required' => 'Details is required'
        ]);

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->mobile = $request->mobile;
        $contact->email = $request->email;
        $contact->details = $request->details;
        $contact->save();

        $id = $contact->id;

        if($id){
            return redirect()->back()->with('success', 'Saved successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
