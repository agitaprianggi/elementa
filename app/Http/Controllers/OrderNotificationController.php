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
        $transaction = ShopOrder::where('order_id', $orderId)->first();
        Log::info('Transaction :', print_r($transaction, true));

        if (!$transaction) {
            Log::error("Transaction not found: " . $orderId);
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // // Update status berdasarkan notifikasi dari Midtrans
        // if ($transactionStatus == 'capture') {
        //     if ($fraudStatus == 'accept') {
        //         $transaction->status = 'success';
        //     }
        // } elseif ($transactionStatus == 'settlement') {
        //     $transaction->status = 'success';
        // } elseif ($transactionStatus == 'pending') {
        //     $transaction->status = 'pending';
        // } elseif ($transactionStatus == 'deny' || $transactionStatus == 'cancel' || $transactionStatus == 'expire') {
        //     $transaction->status = 'failed';
        // } elseif ($transactionStatus == 'refund') {
        //     $transaction->status = 'refunded';
        // }

        // $transaction->save();

        return response()->json(['message' => 'Notification processed successfully']);
    }
}
