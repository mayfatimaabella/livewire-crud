<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/products', function () {
        return view('products.index');
    })->name('products.index');
    
    Route::get('/products/create', function () {
        return view('products.create');
    })->name('products.create');
    
    Route::get('/products/{product}/edit', function (Product $product) {
        return view('products.edit', compact('product'));
    })->name('products.edit');
    
    Route::get('/products/{product}', function (Product $product) {
        return view('products.show', compact('product'));
    })->name('products.show');
});

// Redirect root to products (or login if not authenticated)
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('products.index');
    }
    return redirect()->route('login');
});