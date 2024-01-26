<?php

namespace App\Http\Interfaces\Api;

interface ProductInterface{
    public function index();
    public function store($request);
    public function update($request,$id);
    public function delete($id);
}
