<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::where('user_id', Auth::user()->id)->orderby('created_at', 'desc')->paginate(5);
        return view('android.account.orders', compact('orders'));
    }

    public function show($id){
        $order = Order::findorFail($id);
        return view('android.account.orderDetails', compact('order'));
    }

    public function downloadInvoice($id){
        $order = Order::findorFail($id);
        return view('android.invoice.download', compact('invoice'));
    }
}
