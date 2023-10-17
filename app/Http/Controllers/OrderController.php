<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotification;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function create_checkout()
    {
        $user = Auth::user();
        return view('create_checkout', compact('user'));
    }

    public function checkout(Menu $menu, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|max:13',
            'catatan'
        ]);

        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if ($carts->isEmpty()) {
            return Redirect::back();
        }

        $total_price = 0;

        foreach ($carts as $cart) {

            $total_price += ($cart->menu->harga + $cart->dish->harga) * $cart->jumlah;
        }

        $order = Order::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'catatan' => $request->catatan,
            'total_harga' => $total_price,
            'status' => 'Unpaid'
        ]);


        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $total_price,
            ),
            'customer_details' => array(
                'name' => $request->name,
                'phone' => $request->no_telepon,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('show_order', compact('snapToken', 'order'));
    }

    public function cancel_checkout(Order $order)
    {
        $order->delete();

        return Redirect::route('create_checkout');
    }

    public function show_order(Order $order)
    {
        $user = Auth::user();

        return view('show_order', compact('order'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Paid']);
            }
        }
    }

    public function invoice(Order $order)
    {
        $user = Auth::id();
        $carts = Cart::where('user_id', $user)->get();
        $carts->each(function ($cart) {
            $cart->delete();
        });

        Mail::to('rafa.nugraha2001@gmail.com')->send(new NewOrderNotification($order, $carts));

        return view('invoice', compact('order', 'carts'));
    }
}
