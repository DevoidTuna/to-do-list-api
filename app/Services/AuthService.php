<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return [
            'user' => $user,
            'token' => $user->createToken('to-do-list-spa')->accessToken,
        ];
    }

    public function login(string $email, string $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => 'The provided credentials are incorrect.',
            ]);
        }

        return [
            'user' => $user,
            'token' => $user->createToken('to-do-list-spa')->accessToken,
        ];
    }

    public function logout()
    {
        return Auth::user()->token()->revoke();
    }
}
