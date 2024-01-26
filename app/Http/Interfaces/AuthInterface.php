<?php

namespace App\Http\Interfaces;

interface AuthInterface{
    public function login($request);
    public function logout();

    public function forgetPasswordForm();
    public function sendResetLinkEmail($request);

    public function resetPasswordForm($taken);
    public function resetPassword($request);
}
