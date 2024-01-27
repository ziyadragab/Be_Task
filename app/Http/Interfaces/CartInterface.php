<?php 
namespace App\Http\Interfaces;

interface CartInterface {
    public function create($product);
    public function delete($cart);
}





?>