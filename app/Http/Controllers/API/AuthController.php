<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class AuthController extends Controller
{
   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if (empty($user->api_token)) {
            $token = $user->id . '|' . Str::random(60 - strlen($user->id) - 1);
            $user->api_token = $token;
            $user->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful!',
            'token' => $user->api_token,
        ]);
    }

    return response()->json([
        'status' => false,
        'message' => 'Invalid credentials'
    ], 401);
}
}
