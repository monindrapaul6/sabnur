<?php

namespace App\Services;
use App\Models\Order;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentService
{
    protected Api $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(config('razorpay.key'), config('razorpay.secret'));
//        $this->razorpay = new Api(config('razorpay.key'), config('razorpay.secret'));
    }

    public function order(Order $order)
    {
        $data = [
            'receipt' => strval($order->id),
            'amount' => $order->total * 100,
            'currency' => 'INR'
        ];

        $order = $this->razorpay->order->create($data);

        return [
            'id' => $order->id,
            'receipt' => $order->receipt,
            'amount' => $order->amount,
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

        if ($status == 'captured') return false;

        $payment->capture([
            'amount' => $payment->amount,
            'currency' => 'INR'
        ]);

        return true;
    }
}
