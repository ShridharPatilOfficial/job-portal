<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\JobCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('createUser', [UserController::class, 'createUser'])->name('createUser');

Route::prefix('admin')->middleware('custom.token')->group(function () {
    // All routes here will be prefixed with /admin
    // and protected with custom.token middleware
    Route::post('/logout', [AuthController::class, 'logout']);


       //USERS
        Route::get('getAllUsers', [UserController::class, 'getAllUsers'])->name('getAllUsers');
        Route::get('getUser', [UserController::class, 'getUser'])->name('getUser');  
        Route::post('updateUser', [UserController::class, 'updateUser'])->name('updateUser');


        //SUBCRIPTION AND SUBCRIPTION_HISTORY
        Route::get('checkSubStatus', [AuthController::class, 'checkSubStatus'])->name('checkSubStatus');


    //COMPANY CRUD
    Route::get('getAllCompanies', [CompanyController::class, 'getAllCompanies'])->name('getAllCompanies');
    Route::get('getCompany', [CompanyController::class, 'getCompany'])->name('getCompany');
    Route::post('createCompany', [CompanyController::class, 'createCompany'])->name('createCompany');
    Route::post('updateCompany', [CompanyController::class, 'updateCompany'])->name('updateCompany');
  //  Route::post('deleteCompany', [CompanyController::class, 'deleteCompany'])->name('deleteCompany');


  //JOB CATEGORY CRUD
      Route::get('getAllJobCategories', [JobCategoryController::class, 'getAllJobCategories'])->name('getAllJobCategories');
    Route::get('getJobCategory', [JobCategoryController::class, 'getJobCategory'])->name('getJobCategory');
    Route::post('createJobCategory', [JobCategoryController::class, 'createJobCategory'])->name('createJobCategory');
    Route::post('updateJobCategory', [JobCategoryController::class, 'updateJobCategory'])->name('updateJobCategory');
    Route::post('deleteJobCategory', [JobCategoryController::class, 'deleteJobCategory'])->name('deleteJobCategory');
    

});
    
