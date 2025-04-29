<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/register',[UserController::class,'userRegister'])->name('userRegister');
// Route::get('/register',[UserController::class,'userRegister'])->name('userRegister');
Route::post('/login',[UserController::class,'userLogin'])->name('userLogin');

// Route::get('/email_otp',[UserController::class,'emailOTP'])->name('email_otp');
// Route::get('/verify_otp',[UserController::class,'verifyOTP'])->name('verify_otp');// In routes/api.php

// Route::post('/reset-password', [UserController::class, 'userResetPassword'])->middleware('reset-password');
Route::get('/email_otp',[UserController::class,'emailOTP'])->name('email_otp');

// In routes/api.php
Route::middleware('verify.token')->group(function () {
  
    Route::get('/verify_otp',[UserController::class,'verifyOTP'])->name('verify_otp');// In routes/api.php
    Route::post('/reset_password', [UserController::class, 'userResetPassword'])->name('reset_password');
    
});