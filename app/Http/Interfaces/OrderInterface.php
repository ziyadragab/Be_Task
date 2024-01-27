<?php 
namespace App\Http\Interfaces;

interface OrderInterface {
    public function create();
    public function store($request);
}





?>