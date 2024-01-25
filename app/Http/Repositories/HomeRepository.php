<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\HomeInterface;
use App\Models\Category;
use App\Models\Product;

class HomeRepository implements HomeInterface{

    public function index()
    {
        $products=Product::where('is_available',1)->get();
        $categories=Category::get();
        return view('index',compact(['products','categories']));
    }

    public function storeProduct($request){

        $imagePath = $request->file('image')->store('images', 'public');
       Product::create(
        [
           'name'=>$request->name,
           'price'=>$request->price,
           'description'=>$request->description,
           'image'=>$imagePath,
           'category_id'=>$request->category_id,
           'user_id'=>auth()->user()->id,
        ]
        );
        $products=Product::where('is_available',1)->get();
        return response()->json(['message' => 'Product Created Successfully', 'products' => $products]);
    }
}




?>
