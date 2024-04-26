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
            return response()->json(['success' => true,
                'message' => 'Login unsuccessful',
                'user_id' => Auth::user(),
                'role' => 'USER'
            ]);
        }

        // В случае ошибки аутентификации
        return response()->json(['success' => false,
            'message' => 'Login successful',
            'user_id' => 0,
            'role' => 'USER'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function test(Request $request){

        $token = $request->session()->token();
        return response()->json(['csrf_token' => $token]);
    }
}
