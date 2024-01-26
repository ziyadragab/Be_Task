<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

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
        toast('Bye', 'success');
        return back();
    }

    public function forgetPasswordForm()
    {
        return view('password.forgetPassword');
    }

    public function sendResetLinkEmail($request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );


        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordForm($token)
    {
        return view('password.reset-password', compact('token'));
    }
    public function resetPassword($request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('registerForm')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
