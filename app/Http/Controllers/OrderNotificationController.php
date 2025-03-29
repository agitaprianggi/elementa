<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;
use SCart\Core\Front\Models\ShopOrder;

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

        // Cari transaksi berdasarkan order_id
        $transaction = ShopOrder::where('id', $orderId)->first();

        if (!$transaction) {
            Log::error("Transaction not found: " . $orderId);
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Update status berdasarkan notifikasi dari Midtrans
        if ($transactionStatus == 'settlement') {
            $transaction->payment_status = 3;
            $transaction->status = 2;
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            $transaction->status = 4;
        } elseif ($transactionStatus == 'refund') {
            $transaction->payment_status = 4;
            $transaction->status = 6;
        }

        $transaction->save();

        return response()->json(['message' => 'Notification processed successfully']);
    }
}
