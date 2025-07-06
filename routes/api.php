<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\UserController;
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

    

});
    
