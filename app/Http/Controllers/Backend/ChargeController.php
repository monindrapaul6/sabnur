<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    public function index(){
        $charges = Charge::get();
        return view('backend.charge.index', compact('charges'));
    }

    public function show($id){
        $charge = Charge::where('id', $id)->first();
        return view('backend.charge.show', compact('charge'));
    }

    public function update(Request $request){
        $id = $request->id;
        $charge = Charge::where('id', $id)->update([
            'shipping_charge' => $request->shipping_charge == "" ? 0 : $request->shipping_charge,
            'shipping_total_limit' => $request->shipping_total_limit == "" ? 0 : $request->shipping_total_limit,
            'cod_charge' => $request->cod_charge == "" ? 0 : $request->cod_charge
        ]);

        if($charge) {
            return redirect()->back()->with('success', 'Updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
