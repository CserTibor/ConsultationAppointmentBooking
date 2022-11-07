<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    public function show()
    {
        return View::make('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            return View::make('user-profile',['user' => auth()->user()]);
        }

        return View::make('login');
    }


    public function logout()
    {
        auth()->logout();

        return View::make('login');
    }
}
