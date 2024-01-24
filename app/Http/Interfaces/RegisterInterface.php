<?php 

namespace App\Http\Interfaces;

interface RegisterInterface{
    public function registerForm();
    public function register($request);
}

?>