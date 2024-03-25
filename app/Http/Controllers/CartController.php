<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
        
    public function add_to_cart(Product $product, Request $request)
    {
        $user_id = Auth::id();
        $product_id = $product->id;

        $exsiting_cart = Cart::where('product_id', $product_id)
        ->where('user_id', $user_id)
        ->first();

        if($exsiting_cart == null)
        {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . $product->stock
            ]);        
    
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'amount' => $request->amount
            ]);
        } 

        else
        {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . ($product->stock - $exsiting_cart->amount)
            ]);        
    
            $exsiting_cart->update([
                'amount' => $exsiting_cart->amount + $request->amount
            ]);
        }
        

        return Redirect::route('show_cart');
    }

    public function show_cart()
    {
        $user= Auth::id();
        $carts = Cart::where('user_id', $user)->get();
        return view('show_cart', compact('carts'));
    }

    public function update_cart(Cart $cart, Request $request)
    {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $cart->product->stock
        ]);

        $cart->update([
            'amount' => $request->amount
        ]);

        return Redirect::route('show_cart');
    }

    public function delete_cart(Cart $cart)
    {
        $cart->delete();

        return Redirect::back();
    }
}
