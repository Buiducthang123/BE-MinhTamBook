<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\UserController;
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
Route::get('/user-me', [AuthController::class, 'user'])->middleware('auth:sanctum')->name('user');

// Verify Email
// Route::post('/send-email-verification-notification', [VerifyEmailController::class, 'sendEmailVerificationNotification'])->middleware('auth:sanctum')->name('send-email-verification-notification');
Route::post('/email/verify/', [VerifyEmailController::class, 'verifyEmail'])->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

// Social Login
Route::get('/login/google', [AuthController::class, 'loginGoogle'])->name('login.google');
Route::get('/auth/google/process', [AuthController::class, 'loginGoogleCallback'])->name('login.google.callback');

//User Routes
Route::patch('/user/update-me', [UserController::class, 'updateMe'])->middleware('auth:sanctum')->name('user.update-me');
Route::get('/users', [UserController::class, 'index'])->middleware(['auth:sanctum','admin'])->name('users');
Route::get('/user/{id}', [UserController::class, 'show'])->middleware(['auth:sanctum','admin'])->name('user.show');
Route::patch('/user/{userId}', [UserController::class, 'update'])->middleware(['auth:sanctum','admin'])->name('user.update');


//Role Routes
Route::get('/roles', [RoleController::class, 'getAll'])->middleware(['auth:sanctum','admin'])->name('roles');


//Author Routes
Route::prefix('authors')->middleware(['auth:sanctum','admin'])->group(function(){
    Route::get('/', [AuthorController::class, 'index'])->name('authors.all');
    Route::get('/{id}', [AuthorController::class, 'show'])->name('authors.show');
    Route::post('/', [AuthorController::class, 'create'])->name('authors.create');
    Route::patch('/{id}', action: [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/{id}', [AuthorController::class, 'delete'])->name('authors.delete');
});


//Publisher Routes
Route::prefix('publishers')->middleware(['auth:sanctum','admin'])->group(function(){
    Route::get('/', [PublisherController::class, 'index'])->name('publishers.all');
    Route::post('/', [PublisherController::class, 'create'])->name('publishers.create');
    Route::patch('/{id}', action: [PublisherController::class, 'update'])->name('publishers.update');
    Route::delete('/{id}', [PublisherController::class, 'delete'])->name('publishers.delete');
});

//Book Routes

Route::prefix('books')->middleware(['auth:sanctum','admin'])->group(function(){
    Route::post('/', [BookController::class, 'create'])->name('books.create');
});


//Shipping Address Routes
Route::prefix('shipping-addresses')->middleware('auth:sanctum')->group(function(){
    Route::post('/', [ShippingAddressController::class, 'create'])->name('shipping-addresses.create');
    Route::patch('/{id}', [ShippingAddressController::class, 'update'])->name('shipping-addresses.update');
    Route::delete('/{id}', [ShippingAddressController::class, 'delete'])->name('shipping-addresses.delete');
});
