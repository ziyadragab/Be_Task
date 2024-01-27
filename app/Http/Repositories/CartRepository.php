<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CartInterface;
use App\Models\Cart;

class CartRepository implements CartInterface{

    public function create($product)
    {
        if(!auth()->check()){
            return response(['error' => 'You must be logged in to add products to the cart.']);
        }
        $cart = Cart::where('user_id', auth()->user()->id)
            ->where('product_id', $product)
            ->first();
        if($cart){
            return response(['error' => 'This Product Already Exists In Your Cart.']);
        }
        Cart::create([
           'product_id'=>$product,
           'user_id'=>auth()->user()->id,
        ]);

        return response(['success'=>'The Product Was Added To Your Cart']);
    }

    public function delete($cart)
    {
        $cart->delete();
        return back();
    }
}



?>
