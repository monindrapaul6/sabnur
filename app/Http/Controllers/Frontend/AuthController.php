<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }

    public function login(){
        return view('android.auth.login');
    }

    public function logout(){
        Session::flush ();
        Auth::logout ();
        return redirect("login")->with('success', 'Logged Out Successfully');
    }

    public function flogin(Request $request){
        /*$this->validate($request, [
            'mobile' => 'required',
            'password' => 'required'
        ],[
            'mobile.required' => 'Mobile is required',
            'password.required' => 'Enter Password'
        ]);*/
        $mobile = '+' . $request->get('mobile');
        $fid = $request->get('fid');
        $targetUrl = $request->get('targetUrl');

        $user = User::where('mobile', $mobile)->where('firebase_id', $fid)->first();

        if (!$user) {
            return redirect('login')->with('error', 'Credentials Does not Match');
        }
        else {
            Auth::login($user);
            if($targetUrl == "") {
                return redirect('/')->with('success', 'Logged in successfully');
            }
            else{
                return redirect($targetUrl)->with('success', 'Logged in successfully');
            }
        }
    }
}
