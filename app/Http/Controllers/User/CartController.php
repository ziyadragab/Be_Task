<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\CartInterface;

class CartController extends Controller
{
    private $cartInterface;

    public function __construct(CartInterface $cart)
    {
        $this->cartInterface=$cart;
    }
    public function create($product) {
     return $this->cartInterface->create($product);
    }

    public function delete(Cart $cart) {
        return $this->cartInterface->delete($cart);
       }
}
