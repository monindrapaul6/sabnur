<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\StateCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /*public function setDefaultAddress(Request $request){
        $allAddresses = Address::where('user_id', $request->user_id)->where('id', '!=', $request->id)->get();

        foreach ($allAddresses as $allAddress){
            $allAddress->update(['is_primary' => false]);
        }

        $defaultAddress = Address::where('id', $request->id)->first();

        $defaultAddress->update(['is_primary' => true]);

        return response()->json(['success' => 'Updated', 'defaultAddress' => $defaultAddress]);
    }*/

    public function createAddress(Request $request){
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'contact_no' => 'required',
                'street' => 'required',
                'city' => 'required',
                'state' => 'required|not_in:0',
                'zip' => 'required'
            ], [
                'name.required' => 'Name is required',
                'contact_no.required' => 'Mobile number is required',
                'street.required' => 'Street is required',
                'city.required' => 'City is required',
                'state.required' => 'Street is required',
                'state.not_in' => 'Street is required',
                'zip.required' => 'Zip is required'
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }

        $user = User::where('id', $request->user_id)->first();

        $stateId = $request->state == '0' ? '19' : $request->state;
        $stateCode = StateCode::where('id', $stateId)->first();

        $data = [
            'user_id' => $request->user_id,
            'name' => $request->name == '' ? 'Guest' : $request->name,
            'contact_no' => $request->contact_no == '' ? $user->mobile : $request->contact_no,
            'street' => $request->street,
            'city' => $request->city == '' ? 'Kolkata' : $request->city,
            'country' => $request->country == '' ? 'India' : $request->country,
            'state' => $stateCode->state_name,
            'state_code' => $stateCode->state_code,
            'zip' => $request->zip == "" ? '700001' : $request->zip,
            'locality' => $request->locality,
            'landmark' => $request->landmark,
            'is_primary' => true
        ];

        $addressCreate = Address::create($data);

        $allAddresses = Address::where('user_id', $request->user_id)->where('id', '!=', $addressCreate->id)->get();

        foreach ($allAddresses as $allAddress){
            $allAddress->update(['is_primary' => false]);
        }

        $response = [
            'status' => 200,
            'targetUrl' => $request->targetUrl == 'checkout' ? 'checkout' : 'account/address'
        ];

        return response($response);
    }
}
