<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index(){
        $invoices = Invoice::where('user_id', Auth::user()->id)->orderby('created_at', 'desc')->paginate(5);
        return view('frontend.account.orders', compact('invoices'));
    }

    public function show($invoice_id){
        $invoice = Invoice::findorFail($invoice_id);
        return view('frontend.account.orderDetails', compact('invoice'));
    }

    public function downloadInvoice($id){
        $invoice = Invoice::findorFail($id);
        return view('frontend.invoice.download', compact('invoice'));
    }
}
