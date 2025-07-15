<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\ProductIndex;
use App\Livewire\ProductCreate;
use App\Livewire\ProductEdit;
use App\Livewire\ProductShow;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Logout;

// Authentication Routes (for guests only)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

// Logout route (for authenticated users only)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout')->middleware('auth');

// Protected Livewire Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/products', ProductIndex::class)->name('products.index');
    Route::get('/products/create', ProductCreate::class)->name('products.create');
    Route::get('/products/{product}/edit', ProductEdit::class)->name('products.edit');
    Route::get('/products/{product}', ProductShow::class)->name('products.show');
});

// Redirect root to products (or login if not authenticated)
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('products.index');
    }
    return redirect()->route('login');
});