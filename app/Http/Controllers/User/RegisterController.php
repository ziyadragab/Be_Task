<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Interfaces\RegisterInterface;

class RegisterController extends Controller
{
    private $registerInterface;

    public function __construct(RegisterInterface $register)
    {
        $this->registerInterface = $register;
    }

    public function registerForm()
    {
        return $this->registerInterface->registerForm();
    }
    public function register(RegisterRequest $request)
    {
        return $this->registerInterface->register($request);
    }
}
