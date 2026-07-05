<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        $categories = Category::all();
        return view('checkout.create', compact('event', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20']
        ]);

        if($event->stock <= 0){
            return back()->with('error', 'Maaf sir, tiket sudah habis');
        }

        $orderId = 'TRX-'.time().'-'.Str::random(5);
        $totalPrice = $event->price + 5000; #5000 biaya atmin

        $transaction = Transaction::create([
            'event_id' => $event->id,
            'order_id' => $orderId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'status' => 'Pending'
        ]);

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            "transaction_details" => [
                "order_id" => $orderId,
                "gross_amount" => $totalPrice
            ],
            "customer_details" => [
                "first_name" => $request->customer_name,
                "email" => $request->customer_email,
                "phone" => $request->customer_phone
            ]
        ];

        try{
            $snapToken = Snap::getSnapToken($params);
            $transaction->update(['snap_token' => $snapToken]);

            return redirect()->route('checkout.payment', $transaction->order_id);

        } catch(\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran jaringan: ' . $e->getMessage());
        }


        return redirect('/');
    }

    public function payment($order_id){
        $categories = Category::all();
        $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();

        return view('checkout.payment', compact('transaction', 'categories'));
    }

    public function success($order_id){
        $categories = Category::all();
        $transaction = Transaction::where('order_id', $order_id)->firstOrFail();

        $serverKey = env('MIDTRANS_SERVER_KEY');
        $isProduction = false;

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $status = \Midtrans\Transaction::status($order_id);
            
            if ($status) {
                $trx_status = is_array($status) ? ($status['transaction_status'] ?? '') : ($status->transaction_status ?? '');
                $vaNumber = data_get($status, 'permata_va_number')
                    ?? data_get($status, 'va_numbers.0.va_number')
                    ?? data_get($status, 'bill_key');

                if ($vaNumber && !$transaction->va_number) {
                    $transaction->update(['va_number' => $vaNumber]);
                }
                
                if (in_array($trx_status, ['settlement', 'capture'])) {
                    if (strtolower($transaction->status) === 'pending') {
                        $transaction->update(['status' => 'success']);
                        
                        if ($transaction->event && $transaction->event->stock > 0) {
                            $transaction->event->stock = $transaction->event->stock - 1;
                            $transaction->event->save();
                            
                            try {
                                // \Illuminate\Support\Facades\Mail::to($transaction->customer_email)
                                \Illuminate\Support\Facades\Mail::to('akun.asifurrohman@gmail.com')
                                    ->send(new \App\Mail\EventTicketMail($transaction));
                            } catch (\Exception $e) {
                                \Log::error('Gagal mengirim email E-Ticket secara manual (Bypass): ' . $e->getMessage());
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Jika terjadi error dari API Midtrans (transaksi tidak valid), kembalikan ke beranda
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.');
        }

        return view('checkout.success', compact('transaction', 'categories'));



        // try{
        //     $midtransStatus = \Midtrans\Transaction::status($order_id);

        //     if(in_array($midtransStatus->transaction_status, ['capture', 'settlement'])){
        //         // Jika belum diubah ke success, update status dan kurangi stok
        //         if($transaction->status !== 'success' && $transaction->status !== 'settlement'){
        //             $transaction->update(['status' => 'success']);
        //             Event::where('id', $transaction->event_id)->decrement('stock');
        //         }
        //     }
        // } catch(\Exception $e){
        //     return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.');
        // }

        // return view('checkout.success', compact('transaction','categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
