<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

// Login Routes
Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect('/dashboard');
    }
    return back()->with('error', 'Invalid credentials');
})->name('login.post');

// Register Routes
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect('/')->with('success', 'Registration successful! Please login.');
})->name('register.post');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Protected Inventory Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::post('/products/{id}/stock-in', [ProductController::class, 'stockIn'])->name('products.stockIn');
    Route::post('/products/{id}/stock-out', [ProductController::class, 'stockOut'])->name('products.stockOut');
});