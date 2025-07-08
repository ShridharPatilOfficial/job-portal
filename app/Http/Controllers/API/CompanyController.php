<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Exception;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
     // ✅ Get All Companies
    public function getAllCompanies()
    {
        try {
            $companies = Company::all();

            if ($companies->isEmpty()) {
                return response()->json([
                    "status" => false,
                    "message" => "0 companies found",
                    "data" => []
                ], 404);
            }

            return response()->json([
                "status" => true,
                "message" => "Company list fetched successfully!",
                "data" => $companies
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

    // ✅ Get Single Company
    public function getCompany(Request $request)
    {
        try {
            $company = Company::where('id',$request->com_id)->first();

            if (!$company) {
                return response()->json([
                    "status" => false,
                    "message" => "Company Not found",
                    "data" => []
                ], 404);
            }

            return response()->json([
                "status" => true,
                "message" => "Company fetched successfully!",
                "data" => $company
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

    // ✅ Create Company
    public function createCompany(Request $request)
    {
        try {
            $company = Company::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'email' => $request->email ?? 'NA',
                'phone' => $request->phone ?? 'NA',
                'industry' => $request->industry ?? 'NA',
                'website' => $request->website ?? 'NA',
                'location' => $request->location ?? 'NA',
                'address' => $request->address ?? 'NA',
            ]);
            return response()->json([
                "status" => true,
                "message" => "Company created successfully!",
                "data" => $company
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

    // ✅ Update Company
    public function updateCompany(Request $request)
    {
        try {
         
            $company = Company::find($request->com_id);

            if (!$company) {
                return response()->json([
                    "status" => false,
                    "message" => "Company Not Found",
                    "data" => []
                ], 404);
            }

            $dataToUpdate = [];

            if ($request->has('name')) $dataToUpdate['name'] = $request->name;
            if ($request->has('email')) $dataToUpdate['email'] = $request->email;
            if ($request->has('phone')) $dataToUpdate['phone'] = $request->phone;
            if ($request->has('industry')) $dataToUpdate['industry'] = $request->industry;
            if ($request->has('website')) $dataToUpdate['website'] = $request->website;
            if ($request->has('location')) $dataToUpdate['location'] = $request->location;
            if ($request->has('address')) $dataToUpdate['address'] = $request->address;

            $company->update($dataToUpdate);

            return response()->json([
                "status" => true,
                "message" => "Company updated successfully!",
                "data" => $company
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

    // ✅ Delete Company
    public function deleteCompany(Request $request)
    {
        try {
            $company = Company::find($request->com_id);

            if (!$company) {
                return response()->json([
                    "status" => false,
                    "message" => "0 company found",
                    "data" => []
                ], 404);
            }

            $company->delete();

            return response()->json([
                "status" => true,
                "message" => "Company deleted successfully!",
                "data" => []
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
