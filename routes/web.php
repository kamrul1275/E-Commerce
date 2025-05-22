<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileQRController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Route::get('/',[HomeController::class,'index'])->name('home');

// Route::get('/profile',[HomeController::class,'about'])->name('about');

Route::get('/register',[UserController::class,'userRegister'])->name('userRegister');


// Route::post('/register',[UserController::class,'userRegisterStore'])->name('userRegisterStore');



// Route::get('/profile/{id}', [QRCodeController::class, 'showProfile'])->name('profile');


Route::get('/profile', [QRCodeController::class, 'profile'])->name('profile');



Route::get('/qr_code',[QRCodeController::class,'qrCode'])->name('qr_code');  

// Route::get('/profile',[QRCodeController::class,'showProfile'])->name('profile.show');