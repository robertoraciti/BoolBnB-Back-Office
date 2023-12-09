<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('authToken');

            $userDetails = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                // Aggiungi altri campi se necessario
            ];

            return response()->json([
                'message' => 'Login successful',
                'user' => $userDetails,
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        // Revoca il token di accesso corrente
        if ($request->user()) {
            // Revoca il token di accesso corrente
            $request->user()->token()->revoke();
        }

        return response()->json(['message' => 'Logout successful']);
    }
}