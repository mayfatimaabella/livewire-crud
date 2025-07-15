<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Livewire\ProductIndex;
use App\Livewire\ProductCreate;
use App\Livewire\ProductEdit;
use App\Livewire\ProductShow;

// Authentication Routes (for guests only)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout route (for authenticated users only)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

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