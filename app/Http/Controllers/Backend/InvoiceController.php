<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $invoice = Invoice::active()->orderby('created_at', 'desc');

        /*$dates = explode(' - ', $request->daterange);
        $fromdate = Carbon::parse($dates[0])->format('Y-m-d');
        $todate = Carbon::parse($dates[1])->format('Y-m-d');

        if($dates != ''){
            $invoice->whereBetween('created_at', array($fromdate." 00:00:00", $todate." 23:59:59"));
        }*/

        if($request->status != ""){
            $invoice->where('order_status', $request->status);
        }

        $invoices = $invoice->get();
        return view('backend.invoice.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::findorfail($id);
        return view('backend.invoice.show', compact('invoice'));
    }

    public function update(Request $request)
    {
        $invoice = Invoice::where('id', $request->id)->first();
        $invoice->update([
            'is_paid' => $request->is_paid == 1 ? true : false,
            'payment_status' => $request->is_paid == 1 ? 'success' : 'pending',
            'order_status' => $request->order_status,
            'courier_awb_code' => $request->courier_awb_code,
            'courier_courier_name' => $request->courier_courier_name,
            'status' => $request->is_paid == 1 ? true : false
        ]);

        return redirect()->back()->with('success', 'Updated');
    }


    public function delete($id)
    {
        $category = Category::findorFail($id);
        $category->delete();

        return redirect('admin/categories')->with('success', 'Deleted successfully');
    }
}
