<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function checkSubStatus(Request $request)
    {
        try {
            $userId = $request->user_id;

            if (!$userId) {
                return response()->json([
                    'status' => false,
                    'message' => 'user_id is required',
                    'data' => []
                ], 400);
            }
            $user = User::where('id', $userId)->first();
            $subscription = Subscription::where('user_id', $userId)->latest('id')->first();
            if ($user->role == '2') {
                if ($subscription && $subscription->end_date) {
                    $today = Carbon::today();
                    $endDate = Carbon::parse($subscription->end_date);

                    $subscription_status = $endDate->lt($today) ? 0 : 1;
                    $expire_date = $endDate->toDateString();
                     $isAdmin = 'No';
                } else {
                    $subscription_status = 0;
                    $expire_date = false;
                    $isAdmin = 'No';
                }
            } else {
                $subscription_status = false;
                $expire_date = false;
                $isAdmin = 'Yes';
            }

            return response()->json([
                'status' => true,
                'isAdmin'=>$isAdmin,
                'message' => 'Subscription status fetched successfully!',
                'subscription_status' => $subscription_status,
                'expire_date' => $expire_date,
                'user_data'=> $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }



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

            if ($user->role == 2) {

                $isAdmin = 'No';
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
            } else {
                $subscription_status = false;
                $expire_date = false;
                $isAdmin = 'Yes';
            }


            return response()->json([
                'status' => true,
                'message' => 'Login successful!',
                'token' => $user->api_token,
                'is_admin' => $isAdmin,
                'user_role' => $user->role,
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
