<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/blog-details', function () {
    return view('blog-details');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/shop-details', function () {
    return view('shop-details');
});

Route::get('/shopping-cart', function () {
    return view('shopping-cart');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/contact', function () {
    return view('contact');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Route
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware(['auth', 'verified']);

// Email Verification Routes
Route::get('/email/verify', [AuthController::class, 'showVerifyEmail'])->name('verification.notice')->middleware('auth');
Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->name('verification.send')->middleware(['auth', 'throttle:6,1']);
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify')->middleware(['auth', 'signed', 'throttle:6,1']);

// Password Reset Routes
Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Contact Form Route
Route::view('/contact', 'contactform')->name('contactform');