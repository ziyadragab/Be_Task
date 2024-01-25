<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;

class AuthRepository implements AuthInterface
{

    public function login($request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            toast('Welcome Back', 'success');
            return redirect()->route('index');
        }
        toast('Invalid Credentials', 'error');
        return back();
    }
    public function logout()
    {
        auth()->logout();
        toast('Bye' , 'success');
        return back();
    }
}
