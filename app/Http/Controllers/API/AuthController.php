<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
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

        // Generate API token if missing
        if (empty($user->api_token)) {
            $token = $user->id . '|' . Str::random(60 - strlen($user->id) - 1);
            $user->api_token = $token;
            $user->save();
        }

        // Subscription check from `subscriptions` table
        $subscription = Subscription::where('user_id', $user->id)->latest('id')->first();

        if ($subscription && $subscription->end_date) {
            $today = Carbon::today();
            $endDate = Carbon::parse($subscription->end_date);

            $subscription_status = $endDate->lt($today) ? 0 : 1;
            $expire_date = $endDate->toDateString();
        } else {
            $subscription_status = 0;
            $expire_date = false;
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful!',
            'token' => $user->api_token,
            'subscription_status' => $subscription_status,
            'expire_date' => $expire_date
        ]);
    }

    return response()->json([
        'status' => false,
        'message' => 'Invalid credentials'
    ], 401);
}
}
