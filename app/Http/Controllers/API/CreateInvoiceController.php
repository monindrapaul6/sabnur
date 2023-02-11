<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Charge;
use App\Models\Invoice;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use App\Services\CreateOrderNumberService;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateInvoiceController extends Controller
{
    public function createInvoice(Request $request, CreateOrderNumberService $createOrderNumberService, PaymentService $payment){
        $status = Order::STATUS_INACTIVE;

        $user = User::where('id', $request->user_id)->first();

        $isonlyaccessory = [];
        $iswelcomeoffer = false;
        $checkuseroffer = DB::table('offer_users')->where('user_id', $user->id)->first();

        if(!$checkuseroffer){
            $iswelcomeoffer = true;
        }

        $now = Carbon::now();
        $getoffer = Offer::active()->whereDate('offer_start', '<=', $now->toDateString())->whereDate('offer_expiry', '>=', $now->toDateString())->first();

        $specialdiscount = 0;
        $spdis = 0;

        $carts = Cart::where('user_id', $user->id)->get();

        $product_mrp_price_total = 0;
        $product_current_price_total = 0;
        $product_discount_total = 0;


        foreach ($carts as $cart){
            $product_mrp_price_total += $cart->cart_product->product_mrp_price * $cart->product_quantity;
            $product_current_price_total += $cart->cart_product->product_current_price * $cart->product_quantity;

            if($iswelcomeoffer == true && $getoffer){
                $spdis = !in_array($cart->cart_product->product_category->id, Offer::notApplicableCats) ? Offer::active()->whereDate('offer_start', '<=', $now->toDateString())->whereDate('offer_expiry', '>=', $now->toDateString())->first()->offer_value * $cart->product_quantity : 0;
                $specialdiscount = $specialdiscount + $spdis;
                $isonlyaccessory[] = in_array($cart->cart_product->product_category->id, Offer::notApplicableCats) ? 'acc' : 'nor';
            }

            $orderDatas[] = [
                'address_id' => $user->userDefaultAddress->id,
                'product_id' => $cart->product_id,
                'product_mrp_price' => $cart->cart_product->product_mrp_price,
                'product_current_price' =>  $cart->cart_product->product_current_price,
                'unit_price' =>  $cart->cart_product->unit_price,
                'net_amount' =>  $cart->cart_product->net_amount * $cart->product_quantity,
                'tax_rate' =>  $cart->cart_product->tax_rate,
                'tax_amount' =>  $cart->cart_product->tax_amount * $cart->product_quantity,
                'product_quantity' => $cart->product_quantity,
                'special_discount' => $spdis,
                'product_total_price' => ($cart->cart_product->product_current_price * $cart->product_quantity) - $spdis,
            ];
        }

        $charge = Charge::first();

        if($product_current_price_total < $charge->shipping_total_limit){
            $delivery_charge = $charge->shipping_charge;
        }
        else{
            $delivery_charge = 0;
        }

        if($request->paymentType == 'COD'){
            if($product_current_price_total < 999){
                $cod_charge = $charge->cod_charge;
            }
            else{
                $cod_charge = 0;
            }
            $status = Order::STATUS_ACTIVE;
        }
        else{
            $cod_charge = 0;
        }

        $data = [
            'user_id' => $user->id,
            'address_id' => $user->userDefaultAddress->id,
            'sub_total' => $product_mrp_price_total,
            'discount' => $product_mrp_price_total - $product_current_price_total,
            'delivery_charge' => $delivery_charge,
            'cod_charge' => $cod_charge,
            'special_discount' => $specialdiscount,
            'total' => $product_current_price_total + $delivery_charge + $cod_charge - $specialdiscount,
            'payment_mode' => $request->paymentType,
            'payment_amount' => $product_current_price_total + $delivery_charge + $cod_charge - $specialdiscount,
            'payment_date' => Carbon::now(),
            'transaction_id' => $request->razorpay_payment_id,
            'razorpay_order' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'payment_status' => Order::PAYMENT_PENDING,
            'is_paid' => false,
            'status' => $status
        ];

        $order = Order::create($data);

        foreach($orderDatas as $orderData){
            $invoice = new Invoice;
            $invoice->order_id = $order->id;
            $invoice->user_id = $user->id;
            $invoice->address_id = $user->userDefaultAddress->id;
            $invoice->product_id = $orderData['product_id'];
            $invoice->product_mrp_price = $orderData['product_mrp_price'];
            $invoice->product_current_price = $orderData['product_current_price'];
            $invoice->unit_price = $orderData['unit_price'];
            $invoice->net_amount = $orderData['net_amount'];
            $invoice->tax_rate = $orderData['tax_rate'];
            $invoice->tax_amount = $orderData['tax_amount'];
            $invoice->product_quantity = $orderData['product_quantity'];
            $invoice->special_discount = $orderData['special_discount'];
            $invoice->product_total_price = $orderData['product_total_price'];
            $invoice->payment_status = Order::PAYMENT_PENDING;
            $invoice->is_paid = false;
            $invoice->status = $status;
            $invoice->save();
        }

        if($iswelcomeoffer == true && $getoffer && in_array("nor", $isonlyaccessory)) {
            $insertuseroffer = DB::table('offer_users')->insert(
                array(
                    'offer_id' => $getoffer->id,
                    'user_id' => $user->id
                )
            );
        }

        //return $isonlyaccessory;

        if($request->paymentType == 'COD'){
            $order->update([
                'status' => Order::STATUS_ACTIVE,
                'payment_status' => Order::PAYMENT_PENDING,
                'is_paid' => false
            ]);

            Invoice::query()
                ->where('order_id', $order->id)
                ->update([
                    'payment_status' => Order::PAYMENT_PENDING,
                    'is_paid' => false,
                    'status' => Order::STATUS_ACTIVE
                ]);
        }
        else {
            $orderId = $request->razorpay_order_id;
            $paymentId = $request->razorpay_payment_id;
            $signature = $request->razorpay_signature;

            if (!$payment->signature($orderId, $paymentId, $signature)) {
                $order->update([
                    'payment_status' => Order::PAYMENT_CANCEL,
                ]);

                return response()->json(['success' => 'failed']);
            }

            $payment->capture($paymentId);

            $order->update([
                'status' => Order::STATUS_ACTIVE,
                'payment_status' => Order::PAYMENT_SUCCESS,
                'is_paid' => true,
                'transaction_id' => $paymentId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_order_id' => $orderId,
            ]);

            Invoice::query()
                ->where('order_id', $order->id)
                ->update([
                    'payment_status' => Order::PAYMENT_SUCCESS,
                    'is_paid' => true,
                    'status' => Order::STATUS_ACTIVE
                ]);
        }

        $invoiceOrderId = $createOrderNumberService->createOrderNumber($order->id);

        if($request->type != 'buynow') {
            $this->deleteCartItems($user->id);
        }

        $response = [
            'order_id' => $order->id
        ];

        return $response;
    }

    public function deleteCartItems($userId){
        $carts = Cart::where('user_id', $userId)->get();

        foreach ($carts as $cart){
            $cart->delete();
        }
        return;
    }
}
