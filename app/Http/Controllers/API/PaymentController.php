<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $api = new Api(config('razorpay.key'), config('razorpay.secret'));
        $data = [
            'receipt' => strval(Carbon::now()->format('his')),
            'amount' => $request->amount * 100,
            'currency' => 'INR'
        ];

        $order = $api->order->create($data);

        return [
            'id' => $order->id,
            'receipt' => $order->receipt,
            'amount' => $order->amount,
        ];
    }

    public function createPaymentOrder(Order $order): array
    {
        $api = new Api(config('razorpay.key'), config('razorpay.secret'));
        $data = [
            'receipt' => strval($order->id),
            'amount' => $order->total * 100,
            'currency' => 'INR'
        ];

        $makeorder = $api->order->create($data);

        return [
            'id' => $makeorder->id,
            'receipt' => $makeorder->receipt,
            'amount' => $makeorder->amount,
        ];
    }

    public function signature($orderId, $paymentId, $signature): bool
    {
        $api = new Api(config('razorpay.key'), config('razorpay.secret'));
        $attributes = [
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $signature,
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (SignatureVerificationError $e) {
            return false;
        }
    }

    public function capture($paymentId): bool
    {
        $api = new Api(config('razorpay.key'), config('razorpay.secret'));

        $payment =$api->payment->fetch($paymentId);
        $status = $payment->status;

        if ($status == 'authorized' || $status == 'captured') return false;

        $payment->capture([
            'amount' => $payment->amount,
            'currency' => 'INR'
        ]);

        return true;
    }
}
