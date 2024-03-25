<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function checkout()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if($carts == null)
        {
            return Redirect::back();
        }
        
        $order = Order::create([
            'user_id' => $user_id
        ]);

        // Checkout Error Order_id Dosen Have default Value
        foreach($carts as $cart){
            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product_id
            ]);
        }

        return Redirect::back();
    }
}
