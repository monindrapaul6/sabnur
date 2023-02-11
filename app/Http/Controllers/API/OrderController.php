<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $oos = Order::select('id', 'status', 'created_at')
            ->orderBy('id', 'DESC')
            ->get();

        if (count($oos) > 0) {
            $orders = [];
            foreach ($oos as $oo) {
                $orders[] = [
                    'id' => $oo->id,
                    'status' => $oo->status,
                    'order_date' => Carbon::parse($oo->created_at)->format('d-m-Y')
                ];
            }
            return response()->json(['success' => $orders], 200);
        } else {
            return response()->json(['error' => 'No Order Found'], 404);
        }
    }

    public function invoices(){
        $invs = Invoice::select('id', 'user_id', 'address_id', 'product_id', 'invoice_no', 'product_quantity', 'product_total_price', 'status', 'created_at')
            ->orderBy('id', 'DESC')
            ->get();

        if (count($invs) > 0) {
            $invoices = [];
            foreach ($invs as $inv) {
                $invoices[] = [
                    'id' => $inv->id,
                    'invoice_no' => $inv->invoice_no,
                    'customer_name' => $inv->invoice_user->name,
                    'customer_mobile' => $inv->invoice_user->mobile,
                    'customer_address' => $inv->invoice_address->street . ', ' . $inv->invoice_address->locality . ', ' . $inv->invoice_address->city . ', ' . $inv->invoice_address->state . ', ' . $inv->invoice_address->zip,
                    'product_name' => $inv->invoiceProduct->product_name,
                    'product_dp' => asset($inv->invoiceProduct->productDPImage->image_thumb),
                    'product_quantity' => $inv->product_quantity,
                    'product_total_price' => number_format($inv->product_total_price),
                    'status' => $inv->status,
                    'order_date' => Carbon::parse($inv->created_at)->format('d-m-Y')
                ];
            }
            return response()->json(['success' => $invoices], 200);
        } else {
            return response()->json(['error' => 'No Invoice Found'], 404);
        }
    }

    public function invoiceDetails($id){
        $inv = Invoice::select('id', 'user_id', 'address_id', 'product_id', 'invoice_no', 'product_quantity', 'product_total_price', 'status', 'created_at')
            ->where('id', $id)
            ->first();

        if ($inv) {
            $invoice = [
                'id' => $inv->id,
                'invoice_no' => $inv->invoice_no,
                'customer_name' => $inv->invoice_user->name,
                'customer_mobile' => $inv->invoice_user->mobile,
                'customer_address' => $inv->invoice_address->street . ', ' . $inv->invoice_address->locality . ', ' . $inv->invoice_address->city . ', ' . $inv->invoice_address->state . ', ' . $inv->invoice_address->zip,
                'product_name' => $inv->invoiceProduct->product_name,
                'product_dp' => asset($inv->invoiceProduct->productDPImage->image_thumb),
                'product_quantity' => $inv->product_quantity,
                'product_total_price' => number_format($inv->product_total_price),
                'status' => $inv->status,
                'order_date' => Carbon::parse($inv->created_at)->format('d-m-Y')
            ];
            return response()->json(['success' => $invoice], 200);
        } else {
            return response()->json(['error' => 'No Invoice Found'], 404);
        }
    }
}
