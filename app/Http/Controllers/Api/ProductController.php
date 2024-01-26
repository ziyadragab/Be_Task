<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\ProductInterface;

class ProductController extends Controller
{
    private $productInterface;
    public function __construct(ProductInterface $product)
    {
        $this->productInterface = $product;
    }

    public function index()
    {
        return $this->productInterface->index();
    }

    public function store(Request $requset)
    {
        return $this->productInterface->store($requset);
    }

    public function update(Request $requset,$id)
    {
        return $this->productInterface->update($requset,$id);
    }
    public function delete($id)
    {
        return $this->productInterface->delete($id);
    }
}
