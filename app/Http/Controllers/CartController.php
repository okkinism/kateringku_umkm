<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function add_to_cart(Menu $menu, Request $request)
    {
        $user_id = Auth::id();
        $menu_id = $menu->id;
        $dish = $request->input('dishes');

        $existing_cart = Cart::where('menu_id', $menu_id)
            ->where('user_id', $user_id)
            ->where('dish_id', $dish)
            ->first();

            
        if($existing_cart == null)
        {
            $request->validate([
                'jumlah' => 'required|gte:1'
            ]);

            Cart::create([
                'user_id' => $user_id,
                'menu_id' => $menu_id,
                'dish_id' => $dish,
                'jumlah' => $request->jumlah
            ]);
        }
        else
        {
            $request->validate([
                'jumlah' => 'required|gte:1'
            ]);

            $existing_cart->update([
                'jumlah' => $existing_cart->jumlah + $request->jumlah
            ]);
        }

        return Redirect::route('show_cart');
    }

    public function show_cart()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        return view('show_cart', compact('carts'));
    }

    public function update_cart(Cart $cart, Request $request)
    {
        $request->validate([
            'jumlah' => 'required|gte:1'
        ]);
    
        if ($request->has('jumlah')) {
            $cart->update([
                'jumlah' => $request->jumlah
            ]);
        }
    
        return Redirect::route('show_cart');
    }    

    public function delete_cart(Cart $cart)
    {
        $cart->delete();
        return Redirect::back();
    }
}
