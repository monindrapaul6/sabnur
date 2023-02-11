<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function account(){
        $account = User::where('id', Auth::user()->id)->first();
        return view('android.account.index', compact('account'));
    }

    public function profile(){
        $account = User::where('id', Auth::user()->id)->first();
        return view('android.account.profile', compact('account'));
    }

    public function accountUpdate(Request $request){
        $id = $request->id;
        $request->validate([
            'email' => [Rule::unique('users')->ignore($id),
            ]
        ],[
            'email.unique' => 'Email is already exist'
        ]);
        $account = User::where('id', $request->id)->update([
            'name' => $request->name == "" ? "Guest" : $request->name,
            'email' => $request->email
        ]);

        return redirect()->back();
    }
}
