<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\AuthInterface;

class AuthController extends Controller
{

    private $authInterface;

    public function __construct(AuthInterface $auth)
    {
        $this->authInterface = $auth;
    }

    public function login(AuthRequest $request)
    {
        return $this->authInterface->login($request);
    }
    public function logout()
    {
        return $this->authInterface->logout();
    }
    public function forgetPasswordForm()
    {
        return $this->authInterface->forgetPasswordForm();
    }

    public function sendResetLinkEmail(Request $request)
    {
        return $this->authInterface->sendResetLinkEmail($request);
    }

    public function resetPasswordForm($token)
    {
        return $this->authInterface->resetPasswordForm($token);
    }

    public function resetPassword(Request $request)
    {
        return $this->authInterface->resetPassword($request);
    }
}
