<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Аутентификация прошла успешно
            return redirect()->intended('/');
        }

        // В случае ошибки аутентификации
        return redirect()->back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function test(Request $request){

        $user = [
            'success' => 'good',
            'message' => 'goood',
            'role' => 'krasavshick'
        ];
        return $user;
    }
}
