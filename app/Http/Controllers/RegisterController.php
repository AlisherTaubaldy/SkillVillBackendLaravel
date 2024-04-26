<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $answer = [
            'success' => false,
            'message' => '',
            'user_id' => 0,
            'role' => 'USER'
        ];

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            // Автоматическая аутентификация после регистрации
            Auth::login($user);

        } catch (ValidationException $exception) {

            $errors = $exception->validator->errors();

            foreach ($errors->all() as $message) {
                // Modify error messages based on the field name
                switch ($message) {
                    case str_contains($message, 'name'):
                        $answer['message'] = 'Please enter your name.';
                        break;
                    case str_contains($message, 'email'):
                        if (str_contains($message, 'unique')) {
                            $answer['message'] = 'This email address is already in use.';
                        } else {
                            $answer['message'] = 'Please enter a valid email address.';
                        }
                        break;
                    case str_contains($message, 'password'):
                        if (str_contains($message, 'confirmed')) {
                            $answer['message'] = 'The password confirmation does not match.';
                        } else {
                            $answer['message'] = 'Your password must be at least 8 characters long.';
                        }
                        break;
                }
            }
        }

        return $answer;
    }
}
