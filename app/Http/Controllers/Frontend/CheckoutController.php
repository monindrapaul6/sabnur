<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Charge;
use App\Models\Invoice;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Services\CreateOrderNumberService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $user = Auth::user();

        $iswelcomeoffer = false;
        $checkuseroffer = DB::table('offer_users')->where('user_id', $user->id)->first();

        if(!$checkuseroffer){
            $iswelcomeoffer = true;
        }

        $now = Carbon::now();
        $getoffer = Offer::active()->whereDate('offer_start', '<=', $now->toDateString())->whereDate('offer_expiry', '>=', $now->toDateString())->first();


        if($request->type == 'buynow'){
            $product = Product::where('id', $request->product_id)->first();
            $data[] = [
                "id" => null,
                "user_id" => Auth::user()->id,
                "product_id" => $request->product_id,
                "product_name" => "{{$product->product_name}}",
                "product_quantity" => $request->quantity,
                "cart_data" => null
            ];

            $getcarts = Cart::hydrate($data);
        }
        else {
            $getcarts = Cart::where('user_id', Auth::user()->id)->get();
            if (count($getcarts) <= 0) {
                return redirect('cart')->with('error', 'No Item in Cart');
            }
        }

        //return $getcarts;

        $product_mrp_total = 0;
        $product_current_total = 0;
        $qty = 0;
        $specialdiscount = 0;
        $cartSpecialDis = 0;

        foreach ($getcarts as $getCart) {
            if($iswelcomeoffer == true && $getoffer){
                $cartSpecialDis = !in_array($getCart->cart_product->product_category->id, Offer::notApplicableCats) ? Offer::active()->whereDate('offer_start', '<=', $now->toDateString())->whereDate('offer_expiry', '>=', $now->toDateString())->first()->offer_value * $getCart->product_quantity : 0;
                $specialdiscount += !in_array($getCart->cart_product->product_category->id, Offer::notApplicableCats) ? Offer::active()->whereDate('offer_start', '<=', $now->toDateString())->whereDate('offer_expiry', '>=', $now->toDateString())->first()->offer_value * $getCart->product_quantity : 0;
            }

            $carts[] = [
                'id' => $getCart->id,
                'user_id' => $getCart->user_id,
                'product_id' => $getCart->product_id,
                'product_name' => $getCart->cart_product->product_name,
                'product_slug' => $getCart->cart_product->product_slug,
                'product_dp' => isset($getCart->cart_product->productDPImage->image_thumb) ? asset($getCart->cart_product->productDPImage->image_thumb) : null,
                'product_mrp' => $getCart->cart_product->product_mrp_price,
                'product_current' => $getCart->cart_product->product_current_price,
                'product_quantity' => $getCart->product_quantity,
                'product_total' => $getCart->cart_product->product_current_price * $getCart->product_quantity,
                'special_discount' => $cartSpecialDis,
                'product_discount' => $getCart->cart_product->product_discount,
                'special_total' => ($getCart->cart_product->product_current_price * $getCart->product_quantity) - $cartSpecialDis
            ];

            $product_mrp_total += $getCart->cart_product->product_mrp_price * $getCart->product_quantity;
            $product_current_total += $getCart->cart_product->product_current_price * $getCart->product_quantity;
            $qty = $qty + $getCart->product_quantity;
        }


        $charge = Charge::first();
        $shipping_charge = $product_current_total >= $charge->shipping_total_limit ? 0 : $charge->shipping_charge;

        $sub_total = $product_current_total;
        $discount = $product_mrp_total - $product_current_total;
        $total = $sub_total + $shipping_charge - $specialdiscount;

        /*$response = [
            'user' => $user,
            'carts' => $carts,
            'qty' => $qty,
            'product_mrp_total' => $product_mrp_total,
            'product_current_total' => $product_current_total,
            'discount' => $product_mrp_total - $product_current_total,
            'sub_total' => $sub_total,
            'shipping_charge' => $shipping_charge,
            'specialdiscount' => $specialdiscount,
            'total' => $total
        ];*/

        //return $response;

        return view('android.checkout.index', compact('carts', 'user', 'qty', 'product_mrp_total', 'product_current_total', 'discount', 'sub_total', 'shipping_charge', 'specialdiscount', 'total', 'getoffer'));
    }

    public function checkoutPost(Request $request, CreateOrderNumberService $createOrderNumberService){
        $request->validate([
            'address_id' => 'required'
        ]);

        $data = [
            'order_no' => $createOrderNumberService->createOrderNumber(),
            'user_id' => Auth::user()->id,
            'address_id' => $request->address_id,
            'sub_total' => $request->sub_total,
            'discount' => 0,
            'delivery_charge' => $request->delivery_charge,
            'cod_charge' => 0,
            'total' => $request->total,
            'payment_mode' => $request->paymentType,
            'payment_amount' => $request->total
        ];

        $invoice = Invoice::create($data);
        $invoiceId = $invoice->id;

        $i = 0;
        foreach ($request->ids as $id){
            $product = Product::where('id', $id)->select('product_mrp_price', 'product_current_price', 'unit_price', 'net_amount', 'tax_rate', 'tax_amount', 'is_combo')->first();

            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->invoice_id = $invoiceId;
            $order->address_id = $request->address_id;
            $order->product_id = $id;
            $order->order_no = $createOrderNumberService->createOrderNumber();
            $order->product_mrp_price = $product->product_mrp_price;
            $order->product_current_price = $product->product_current_price;
            $order->unit_price = $product->unit_price;
            $order->net_amount = $product->net_amount;
            $order->tax_rate = $product->tax_rate;
            $order->tax_amount = $product->tax_amount;
            $order->product_quantity = $request->quantity[$i];
            $order->product_total_price = $request->product_total_price[$i];
            $order->save();
            $i++;
        }

        //$cart = session()->forget('cart');

        //Session::forget($id);
        return redirect('confirm/'.$invoiceId)->with('success', 'Order Placed');
    }

    public function confirmOrder($invoice_id){
        $invoice = Invoice::findorFail($invoice_id);

        if($invoice->payment_mode == 'COD'){
            $invoice->update([
                'status' => 'ACTIVE'
            ]);

            foreach($invoice->invoice_orders as $order) {
                $order->update([
                    'status' => 'ACTIVE'
                ]);
            }
            return redirect('/account/invoice/' . $invoice->id);
        }

        return view('android.checkout.confirm', compact('invoice'));


        if($invoice_id == null){
            abort(404);
        }

        $invoice = Invoice::where('id', $invoice_id)->first();
        if(!$invoice){
            abort(404);
        }

        $shipping = Charge::select('cod_charge')->first();
        /*if($invoice->sub_total >= $shipping->shipping_total_limit){
            $shipping_charge = 0;
        }
        else{
            $shipping_charge = $shipping->shipping_charge;
        }*/

        $cod_charge = !$shipping ? 0 : $shipping->cod_charge;

        return $cod_charge;

        $is_cod = DB::table('postal_zips')->where('zip', $invoice->invoice_address->zip)->first();
        if(!$is_cod || $is_cod->is_cod == 'NO'){
            $availability = 'NO';
        }
        else{
            $availability = 'YES';
        }
        return view('android.checkout.confirm', compact('title', 'description', 'ogpic', 'invoice', 'shipping', 'availability', 'cod_charge'));
    }
}
