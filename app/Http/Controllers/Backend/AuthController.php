<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function login(){
        return view('backend.auth.login');
    }

    public function postlogin(Request $request){
        $this->validate($request, [
            'mobile' => 'required',
            'password' => 'required'
        ],[
            'mobile.required' => 'Mobile is required',
            'password.required' => 'Enter Password'
        ]);
        $mobile = '+91' . $request->get('mobile');
        $password = $request->get('password');

        if (Auth::attempt(['mobile' => $mobile , 'password' => $password])) {
            $user = Auth::user();
            if($user->permission == 'ADMIN') {
                return redirect('/admin')->with('success', 'Logged In Successfully');
            }
            else{
                return redirect()->intended();
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Credentials Does not Match');
        }
    }

    public function adminLogout(){
        Session::flush ();
        Auth::logout ();
        return redirect("admin/login")->with('success', 'Logged Out Successfully');
    }
}
