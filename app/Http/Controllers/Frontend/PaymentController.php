<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function makePayment(Request $request){
        $invoice = Invoice::where('id', $request->invoice_id)->first();

        $invoice->update([
            'is_paid' => true,
            'status' => 'ACTIVE'
        ]);

        foreach ($invoice->invoice_orders as $order){
            $order->update([
                'is_paid' => true,
                'status' => 'ACTIVE'
            ]);
        }

        $arr = array('msg' => 'Payment successful', 'status' => true);
        return Response()->json($arr);
    }
}
