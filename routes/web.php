<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Route::get('/',[HomeController::class,'index'])->name('home');

// Route::get('/profile',[HomeController::class,'about'])->name('about');

Route::get('/register',[UserController::class,'userRegister'])->name('userRegister');