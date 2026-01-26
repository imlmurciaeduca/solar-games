<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(AuthRequest $request) {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                'message' => 'Lo siento mucho, me he equivocado y no volverá a pasar'
            ], 400);
        }

        $token = Auth::user()->createToken('Token para ' . Auth::user()->email, expiresAt: now()->addMonth());

        return response()->json([
            'message' => 'Todo gucci',
            'token' => $token->plainTextToken
        ]);
    }

    public function logout() {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Cierre de sesión satisfactorio'
        ]);
    }

}
