<?php

namespace App\Http\Repositories;

use App\Models\Cart;
use App\Models\Order;
use App\Http\Interfaces\OrderInterface;
use Illuminate\Support\Facades\Redirect;

class OrderRepository implements OrderInterface
{

    public function create()
    {
        $carts = Cart::get();
        return view('order.create', compact('carts'));
    }
    public function store($request)
    {
        $order = Order::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "country" => $request->country,
            "city" => $request->city,
            "zip_code" => $request->zip_code,
            "total_price" => $request->total_price,
            'user_id' => auth()->user()->id
        ]);
    
        return Redirect::to("myfatoorah/{$order->id}");
    }
}
