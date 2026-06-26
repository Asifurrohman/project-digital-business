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

        // $transaction = Transaction::create([
        //     'event_id' => $event->id,
        //     'order_id' => $orderId,
        //     'customer_name' => $request->customer_name,
        //     'customer_email' => $request->customer_email,
        //     'customer_phone' => $request->customer_phone,
        //     'total_price' => $totalPrice,
        //     'status' => 'Pending'
        // ]);

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
