<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistrationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Login Routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect(Auth::user()->isAdmin() ? '/admin/dashboard' : '/dashboard');
    }

    return view('login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect(Auth::user()->isAdmin() ? '/admin/dashboard' : '/dashboard');
    }

    return back()->with('error', 'Invalid credentials');
})->name('login.post');

// Register Routes
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'sendOtp'])->name('register.post');
Route::get('/otp/verify', [RegistrationController::class, 'showOtpForm'])->name('otp.verify');
Route::post('/otp/verify', [RegistrationController::class, 'verifyOtp'])->name('otp.verify.post');

Route::post('/logout', function () {
    Auth::logout();

    return redirect('/');
})->name('logout');

// Protected Inventory Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::post('/products/{id}/stock-in', [ProductController::class, 'stockIn'])->name('products.stockIn');
    Route::post('/products/{id}/stock-out', [ProductController::class, 'stockOut'])->name('products.stockOut');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
