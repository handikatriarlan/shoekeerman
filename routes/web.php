<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
