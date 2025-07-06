<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAllUsers()
    {
        try {
            $users = User::with(['userDetails', 'userExperiences', 'userEducations'])->get();

            if ($users->isEmpty()) {
                return response()->json([
                    "status" => false,
                    "message" => "0 users found",
                    "data" => []
                ], 404);
            }

            return response()->json([
                "status" => true,
                "message" => "User list fetched successfully!",
                "data" => $users
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!",
                "error" => $e->getMessage(),
                "data" => []
            ], 500);
        }
    }

    public function getUser(Request $request)
    {
        try {
            $user = User::with(['userDetails', 'userExperiences', 'userEducations'])->find($request->id);

            if (!$user) {
                return response()->json([
                    "status" => false,
                    "message" => "0 user found",
                    "data" => []
                ], 404);
            }

            return response()->json([
                "status" => true,
                "message" => "User fetched successfully!",
                "data" => $user
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!",
                "error" => $e->getMessage(),
                "data" => []
            ], 500);
        }
    }

    public function createUser(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => $request->status ?? 0,
            ]);

            return response()->json([
                "status" => true,
                "message" => "User created successfully!",
                "data" => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!",
                "error" => $e->getMessage(),
                "data" => []
            ], 500);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $user = User::find($request->id);

            if (!$user) {
                return response()->json([
                    "status" => false,
                    "message" => "0 user found",
                    "data" => []
                ], 404);
            }

            $user->update($request->only([
                'name', 'email', 'phone', 'gender', 'role', 'status', 'marital_status',
                'dob', 'religion', 'address', 'aadhar_no', 'languages'
            ]));

            return response()->json([
                "status" => true,
                "message" => "User updated successfully!",
                "data" => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!",
                "error" => $e->getMessage(),
                "data" => []
            ], 500);
        }
    }
}

