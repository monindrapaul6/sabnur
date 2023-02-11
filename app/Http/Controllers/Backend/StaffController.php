<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index(){
        $staffs = User::active()->where('permission', '!=', 'CUSTOMER')->get();
        return view('backend.staff.index', compact('staffs'));
    }

    public function show($id){
        $staff = User::active()->where('id', $id)->first();
        return view('backend.staff.show', compact('staff'));
    }

    public function update(Request $request){
        $id = $request->id;
        $request->validate([
            'name' => 'required',
            'email' => ['nullable',
                Rule::unique('users')->ignore($id),
            ],
            'mobile' => ['required',
                Rule::unique('users')->ignore($id),
            ]
        ],[
            'email.unique' => 'Email is already exists',
            'mobile.required' => 'Mobile is required',
            'mobile.unique' => 'Mobile number already exists'
        ]);
        if($request->password != ''){
            $user = User::where('id', $id)->update(['name' => $request->name, 'email' => $request->email, 'mobile' => $request->mobile, 'permission' => $request->permission, 'status' => $request->status, 'password' => bcrypt($request->password)]);
        }
        else{
            $user = User::where('id', $id)->update(['name' => $request->name, 'email' => $request->email, 'mobile' => $request->mobile, 'permission' => $request->permission, 'status' => $request->status]);
        }

        if($user){
            return redirect()->back()->with('success', 'Updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong successfully');
        }
    }

    public function create(){
        return view('backend.staff.create');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'email|unique:users',
            'mobile' => 'required|unique:users',
            'password' => 'required'
        ],[
            'email.email' => 'Valid Email is required',
            'email.unique' => 'Email already exists',
            'mobile.required' => 'Mobile is required',
            'mobile.unique' => 'Mobile number already exists',
            'password.required' => 'Password is required'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = '+91' . $request->mobile;
        $user->password = bcrypt($request->password);
        $user->permission = $request->permission;
        $user->save();

        $id = $user->id;
        if($id){
            return redirect()->back()->with('success', 'Updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong successfully');
        }
    }

    public function delete($id){
        User::where('id', $id)->update(['status' => 'INACTIVE']);
        return redirect('admin/staffs')->with('success', 'Deleted successfully');
    }
}
