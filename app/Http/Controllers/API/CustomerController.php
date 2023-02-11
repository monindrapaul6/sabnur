<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index(){
        $custs = User::select('id', 'name', 'mobile', 'email')
            ->where('permission', User::PERMISSION_CUSTOMER)
            ->orderBy('id', 'DESC')
            ->get();

        if (count($custs) > 0) {
            $customers = [];
            foreach ($custs as $cust) {
                $customers[] = [
                    'id' => $cust->id,
                    'name' => $cust->name,
                    'mobile' => $cust->mobile,
                    'email' => $cust->email
                ];
            }
            return response()->json(['success' => $customers], 200);
        } else {
            return response()->json(['error' => 'No Customer Found'], 404);
        }
    }

    public function show($id){
        $cust = User::select('id', 'name', 'mobile', 'email')
            ->where('id', $id)
            ->first();

        if ($cust) {
            $customer = [
                'id' => $cust->id,
                'name' => $cust->name,
                'mobile' => $cust->mobile,
                'email' => $cust->email
            ];
            return response()->json(['success' => $customer], 200);
        } else {
            return response()->json(['error' => 'No Customer Found'], 404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'email|unique:users',
                'mobile' => 'required|unique:users'
            ], [
                'name.required' => 'Valid Name is required',
                'email.email' => 'Valid Email is required',
                'email.unique' => 'Email already exists',
                'mobile.required' => 'Mobile is required',
                'mobile.unique' => 'Mobile number already exists'
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }

        $defaultPassword = User::DefaultPassword;

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($defaultPassword);
        $user->permission = User::PERMISSION_CUSTOMER;
        $user->save();

        $id = $user->id;
        if($id){
            return response()->json(['success' => 'Updated successfully'], 200);
        }
        else{
            return response()->json(['error' => 'Something went wrong'], 200);
        }
    }

    public function update(Request $request){
        $id = $request->id;

        if(!$id){
            return response()->json(["status" => 404, 'message' => 'Please provide Customer Id']);
        }

        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => ['nullable',
                    Rule::unique('users')->ignore($id),
                ],
                'mobile' => ['required',
                    Rule::unique('users')->ignore($id),
                ],
                'permission' => 'required',
                'status' => 'required'
            ], [
                'name.required' => 'Valid Name is required',
                'email.unique' => 'Email is already exists',
                'mobile.required' => 'Mobile is required',
                'mobile.unique' => 'Mobile number already exists',
                'permission.required' => 'Permission is required',
                'status.required' => 'Status is required'
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }

        $user = User::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'permission' => $request->permission,
                'status' => $request->status
            ]);

        if($user){
            return response()->json(['success' => 'Updated successfully'], 200);
        }
        else{
            return response()->json(['error' => 'Something went wrong'], 200);
        }
    }
}
