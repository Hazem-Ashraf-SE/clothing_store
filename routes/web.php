<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SocialiteController;

// Home Page
Route::get('/', function () {
    return view('webfront.home');
});

// Web Pages (about, blog, etc.)
Route::prefix('')->group(function () {
    Route::view('/about', 'webfront.about')->name('about');
    Route::view('/blog', 'webfront.blog')->name('blog');
    Route::view('/blog-details', 'webfront.blog-details')->name('blog.details');
    Route::view('/shop', 'webfront.shop')->name('shop');
    Route::view('/shop-details', 'webfront.shop-details')->name('shop.details');
    Route::view('/shopping-cart', 'webfront.shopping-cart')->name('cart');
    Route::view('/checkout', 'webfront.checkout')->name('checkout');
    Route::view('/contact', 'webfront.contact')->name('contact');
});

// Contact Form Route
Route::view('/contactform', 'webfront.contactform')->name('contactform');

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

// Socialite Routes
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.callback');

// Account Management Routes
Route::middleware(['auth'])->group(function () {
    Route::delete('/account/delete', [AuthController::class, 'deleteAccount'])->name('account.delete');
});