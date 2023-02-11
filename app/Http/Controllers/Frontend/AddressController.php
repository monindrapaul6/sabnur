<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\StateCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $addresses = Address::active()->where('user_id', Auth::user()->id)->orderBy('is_primary', 'desc')->get();

        $targetUrl = isset($request->targetUrl) ? $request->targetUrl : null;

        $states = StateCode::select('id', 'state_name', 'state_code')->get();
        return view('android.account.address', compact('addresses', 'targetUrl', 'states'));
    }

    public function create(Request $request){
        $targetUrl = isset($request->targetUrl) ? $request->targetUrl : null;

        $states = StateCode::select('id', 'state_name', 'state_code')->get();
        return view('android.account.addressCreate', compact('states', 'targetUrl'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'contact_no' => 'required',
            'street' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required|not_in:0',
            'zip' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
        ]);

        $getaddress = Address::where('user_id', Auth::user()->id)->where('is_primary', true)->get();

        if(count($getaddress) > 0){
            $is_primary = false;
        }
        else{
            $is_primary = true;
        }

        $stateCode = StateCode::where('id', $request->state)->first();

        $data = [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'street' => $request->street,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $stateCode->state_name,
            'state_code' => $stateCode->state_code,
            'zip' => $request->zip,
            'locality' => $request->locality,
            'landmark' => $request->landmark,
            'is_primary' => $is_primary
        ];

        $addressCreate = Address::create($data);

        $targetUrl = isset($request->targetUrl) ? $request->targetUrl : '/account/address';

        if($addressCreate){
            return redirect($targetUrl)->with('success', 'Address created successfully');
            //return redirect()->intended()->with('success', 'Address created successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show($id){
        $address = Address::findorFail($id);
        $states = StateCode::select('id', 'state_name', 'state_code')->get();
        return view('android.account.addressDetails', compact('address', 'states'));
    }

    public function update(Request $request){
        /*$request->validate([
            'name' => 'required',
            'contact_no' => 'required',
            'street' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required_not_in:0',
            'zip' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
        ]);*/

        $stateCode = StateCode::where('id', $request->state)->first();

        $data = [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'street' => $request->street,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $stateCode->state_name,
            'state_code' => $stateCode->state_code,
            'zip' => $request->zip,
            'locality' => $request->locality,
            'landmark' => $request->landmark
        ];

        $addressUpdate = Address::where('id', $request->id)->update($data);

        if($addressUpdate){
            return redirect()->back()->with('success', 'Address updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function delete($id){
        $addressInfo = Address::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if($addressInfo->is_primary == true){
            return redirect()->back()->with('error', 'You can not delete primary address');
        }

        $addressDelete = $addressInfo->update(['status' => 'INACTIVE']);

        if($addressDelete){
            return redirect('account/address')->with('success', 'Deleted successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function makeDefault($id){
        $getAdresses = Address::where('id', '!=', $id)->where('user_id', Auth::user()->id)->get();

        foreach($getAdresses as $getAdress){
            $getAdress->update([
                'is_primary' => false
            ]);
        }

        $defaultAddress = Address::where('id', $id)->update(['is_primary' => true]);

        if($defaultAddress){
            return redirect()->back()->with('success', 'Updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
