<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderInterface;

class OrderController extends Controller
{
    private $orderInterface;

    public function __construct(OrderInterface $order)
    {
        $this->orderInterface=$order;
    }
    public function create()
    {
     return $this->orderInterface->create();
    }
    public function store(OrderRequest $request)
     {
        
        return $this->orderInterface->store($request);
     }
}
