<?php

namespace App\Http\Controllers;

use App\Mail\EventTicketMail;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request){
        $payload = $request->all();
        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$orderId) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        $transaction = Transaction::with('event')->where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        if ($vaNumber = $this->extractVaNumber($payload)) {
            $transaction->va_number = $vaNumber;
        }

        if ($transaction->status === 'settlement' || $transaction->status === 'success') {
            return response()->json(['message' => 'Already processed']);
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $transaction->status = 'challenge';
            } else if ($fraudStatus == 'accept') {
                $transaction->status = 'success';
                $this->processSuccess($transaction);
            }
        } else if ($transactionStatus == 'settlement') {
            $transaction->status = 'settlement';
            $this->processSuccess($transaction);
        } else if (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $transaction->status = 'failed';
        } else if ($transactionStatus == 'pending') {
            $transaction->status = 'pending';
        }

        $transaction->save();
        return response()->json(['message' => 'OK']);
    }

    private function extractVaNumber(array $payload): ?string
    {
        if (isset($payload['permata_va_number'])) {
            return $payload['permata_va_number'];
        }

        if (isset($payload['va_numbers']) && is_array($payload['va_numbers']) && isset($payload['va_numbers'][0]['va_number'])) {
            return $payload['va_numbers'][0]['va_number'];
        }

        if (isset($payload['bill_key'])) {
            return $payload['bill_key'];
        }

        return null;
    }

    private function processSuccess(Transaction $transaction){
        // Kurangi stok event sebanyak 1
        // if ($transaction->event_id) {
        //     Event::where('id', $transaction->event_id)->decrement('stock');
        // }

        $event = $transaction->event;

            if ($event && $event->stock > 0) {
                $event->stock = $event->stock - 1;
                $event->save();
            
            // Mengirimkan email E-Ticket ke pelanggan
            try {
                // Mail::to($transaction->customer_email)->send(new EventTicketMail($transaction));
                Mail::to('akun.asifurrohman@gmail.com')->send(new EventTicketMail($transaction));
            } catch (\Exception $e) {
                // \Log::error('Gagal mengirim email E-Ticket: ' . $e->getMessage());
                \Log::error("Gagal mengirim email E-Ticket: " . $e->getMessage());
            }
        } else {
            \Log::warning('Stock habis setelah pembayaran berhasil (Perlu proses refund opsional). Order: ' . $transaction->order_id);
        }

    }
}
