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
            $userData = [];

            // Handle profile file upload
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = time() . '_' . $file->getClientOriginalName();
                $profilePath = $file->storeAs('profiles', $filename, 'public');
                $userData['profile'] = asset('storage/' . $profilePath);
            }

            // Optional fields
            if ($request->has('name')) $userData['name'] = $request->name;
            if ($request->has('email')) $userData['email'] = $request->email;
            if ($request->has('phone')) $userData['phone'] = $request->phone;
            if ($request->has('gender')) $userData['gender'] = $request->gender;
            if ($request->has('role')) $userData['role'] = $request->role;
            if ($request->has('status')) $userData['status'] = $request->status;
            if ($request->has('marital_status')) $userData['marital_status'] = $request->marital_status;
            if ($request->has('dob')) $userData['dob'] = $request->dob;
            if ($request->has('religion')) $userData['religion'] = $request->religion;
            if ($request->has('address')) $userData['address'] = $request->address;
            if ($request->has('aadhar_no')) $userData['aadhar_no'] = $request->aadhar_no;
            if ($request->has('languages')) $userData['languages'] = $request->languages;

            // Required password
            $userData['password'] = Hash::make($request->password);

            $user = User::create($userData);

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

            $dataToUpdate = [];

            // Handle profile file update
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = time() . '_' . $file->getClientOriginalName();
                $profilePath = $file->storeAs('profiles', $filename, 'public');
                $dataToUpdate['profile'] = asset('storage/' . $profilePath);
            }

            // Optional fields
            if ($request->has('name')) $dataToUpdate['name'] = $request->name;
            if ($request->has('email')) $dataToUpdate['email'] = $request->email;
            if ($request->has('phone')) $dataToUpdate['phone'] = $request->phone;
            if ($request->has('gender')) $dataToUpdate['gender'] = $request->gender;
            if ($request->has('role')) $dataToUpdate['role'] = $request->role;
            if ($request->has('status')) $dataToUpdate['status'] = $request->status;
            if ($request->has('marital_status')) $dataToUpdate['marital_status'] = $request->marital_status;
            if ($request->has('dob')) $dataToUpdate['dob'] = $request->dob;
            if ($request->has('religion')) $dataToUpdate['religion'] = $request->religion;
            if ($request->has('address')) $dataToUpdate['address'] = $request->address;
            if ($request->has('aadhar_no')) $dataToUpdate['aadhar_no'] = $request->aadhar_no;
            if ($request->has('languages')) $dataToUpdate['languages'] = $request->languages;

            $user->update($dataToUpdate);

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
