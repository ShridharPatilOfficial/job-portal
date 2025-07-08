<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Exception;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
     // ✅ Get All Job Categories
    public function getAllJobCategories()
    {
        try {
            $categories = JobCategory::all();

            return response()->json([
                'status' => true,
                'message' => 'Job category list fetched successfully!',
                'data' => $categories
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    // ✅ Get Single Job Category
    public function getJobCategory(Request $request)
    {
        try {
            $category = JobCategory::find($request->cat_id);

            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => '0 job category found',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Job category fetched successfully!',
                'data' => $category
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    // ✅ Create Job Category
    public function createJobCategory(Request $request)
    {
        try {
            $category = JobCategory::create([
                'name' => $request->name,
                'type' => $request->type,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Job category created successfully!',
                'data' => $category
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    // ✅ Update Job Category
    public function updateJobCategory(Request $request)
    {
        try {
            $category = JobCategory::find($request->cat_id);

            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => '0 job category found',
                    'data' => []
                ], 404);
            }

            $updateData = [];
            if ($request->has('name')) $updateData['name'] = $request->name;
            if ($request->has('type')) $updateData['type'] = $request->type;

            $category->update($updateData);

            return response()->json([
                'status' => true,
                'message' => 'Job category updated successfully!',
                'data' => $category
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    // ✅ Delete Job Category
    public function deleteJobCategory(Request $request)
    {
        try {
            $category = JobCategory::find($request->cat_id);

            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => '0 job category found',
                    'data' => []
                ], 404);
            }

            $category->delete();

            return response()->json([
                'status' => true,
                'message' => 'Job category deleted successfully!',
                'data' => []
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
}
