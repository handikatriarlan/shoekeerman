<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

//Landing Page Routes
Route::get('/', function () {
    return view('landing.landing-page');
})->name('home');


Route::get('/cart', function () {
    return view('landing.shopping-cart');
})->name('cart');

//Auth Routes
Route::get('/login', [AuthController::class, 'showloginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/search', function () {
    return view('search');
});
Route::get('/products', function () {
    return view('products');
});

// Admin Routes
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Category Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

// Product Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

// Users Management
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Order
Route::prefix('orders')->group(function () {
    Route::get('/', [OrdersController::class, 'index'])->name('admin.orders.index');
    // Route::post('/', [OrdersController::class, 'store'])->name('admin.orders.store');
    Route::patch('/{order}/status', [OrdersController::class, 'updateStatus'])->name('admin.orders.update-status ');
    // Route::delete('/{order}', [OrdersController::class, 'destroy'])->name('admin.orders.destroy');
});


// Order History
