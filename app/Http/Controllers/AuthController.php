<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showAuthForm()
    {
        return view('auth.form.auth_form');
    }

    public function showLoginForm()
    {
        return view('auth.form.login');
    }

    public function showRegisterForm()
    {
        return view('auth.form.register');
    }

}





