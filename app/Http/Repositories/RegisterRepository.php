<?php 
namespace App\Http\Repositories;

use App\Http\Interfaces\RegisterInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterRepository implements RegisterInterface{
    public function registerForm()
    {
        return view('signUp');
    }
    public function register($request)
    {
       User::create(
        [
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>Hash::make($request->password),
        ]
       );
       toast('User Created Successfully','success');
       return back();

    }
}








?>