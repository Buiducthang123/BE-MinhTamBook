<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Auth Routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');


// Verify Email
// Route::post('/send-email-verification-notification', [VerifyEmailController::class, 'sendEmailVerificationNotification'])->middleware('auth:sanctum')->name('send-email-verification-notification');
Route::post('/email/verify/', [VerifyEmailController::class, 'verifyEmail'])->middleware(['auth:sanctum', 'signed'])->name('verification.verify');
