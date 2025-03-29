<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;
use SCart\Core\Front\Models\ShopOrder;
use SCart\Core\Front\Models\ShopOrderTotal;

class OrderNotificationController extends Controller
{
    public function handleTransaction(Request $request)
    {
        // Log data yang diterima untuk debugging
        Log::info('Midtrans Notification:', $request->all());

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_ENVIRONMENT') == 'production' ? true : false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Ambil notifikasi dari Midtrans
        $notification = new Notification();

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;
        $grossAmount = (int) $notification->gross_amount;

        // Cari transaksi berdasarkan order_id
        $transaction = ShopOrder::where('id', $orderId)->first();

        if (!$transaction) {
            Log::error("Transaction not found: " . $orderId);
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        
        $total_transaction = ShopOrderTotal::where('order_id', $orderId)->where('code', 'received')->first();

        if (!$total_transaction) {
            Log::error("Total Transaction not found: " . $orderId);
            return response()->json(['message' => 'Total Transaction not found'], 404);
        }

        // Update status berdasarkan notifikasi dari Midtrans
        if ($transactionStatus == 'settlement') {
            $transaction->received = -$grossAmount;
            $transaction->balance = 0;
            $transaction->payment_status = 3;
            $transaction->status = 2;

            $total_transaction->value = sc_currency_value($grossAmount);
            $total_transaction->text = sc_currency_render($grossAmount);
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            $transaction->status = 4;
        } elseif ($transactionStatus == 'refund') {
            $transaction->payment_status = 4;
            $transaction->status = 6;
        }

        $total_transaction->save();
        $transaction->save();

        return response()->json(['message' => 'Notification processed successfully']);
    }
}
