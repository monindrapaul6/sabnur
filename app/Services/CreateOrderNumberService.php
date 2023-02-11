<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Service\OrderNumber;
use Carbon\Carbon;

class CreateOrderNumberService
{
    public function createOrderNumber($orderId){
        $invoicePrefix = OrderNumber::INVOICE_PREFIX;
        $orderPrefix = OrderNumber::ORDER_PREFIX;
        $dateNow = Carbon::now()->format('Ymd');

        $lastOrder = OrderNumber::orderby('id', 'desc')->first();
        $invoiceUniqueNo = isset($lastOrder->invoice_unique_no) ? $lastOrder->invoice_unique_no + 1 : 1;
        $orderUniqueNo = isset($lastOrder->order_unique_no) ? $lastOrder->order_unique_no + 1 : 1;

        $order_no = $orderPrefix . $dateNow . sprintf("%05d", $orderUniqueNo);

        $order = Order::where('id', $orderId)->first();
        $invoices = $order->orderInvoices;

        foreach ($invoices as $invoice) {
            $invoice_no = $invoicePrefix . $dateNow . sprintf("%05d", $invoiceUniqueNo);;


            $orderNo = new OrderNumber;
            $orderNo->order_id = $orderId;
            $orderNo->order_no = $order_no;
            $orderNo->order_unique_no = $orderUniqueNo;
            $orderNo->invoice_no = $invoice_no;
            $orderNo->invoice_unique_no = $invoiceUniqueNo;
            $orderNo->save();

            $invoice->update([
                'order_no' => $order_no,
                'invoice_no' => $invoice_no
            ]);

            $invoiceUniqueNo++;
        }

        $order->update([
            'order_no' => $order_no
        ]);

        $response = [
            'order_no' => $orderId
        ];
        return $response;
    }
}
