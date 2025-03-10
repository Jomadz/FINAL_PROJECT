<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;

Route::middleware(['auth'])->group(function () {
    Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
    Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create'); // Add this if you want a separate route for the form
});


//product routes
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Group profile routes under auth middleware
Route::middleware(['auth'])->group(function () {
    // Show profile information & image upload form
    Route::get('/profile', [ProfileController::class, 'showForm'])->name('profile.show');

    // Handle profile updates (like name, email)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

     // Handle profile updates (like name, email)
     Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/profile/image/update', [ProfileImageController::class, 'update'])->name('profile.image.update');
});





Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');


// Route for the admin to create a seller
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Admin can create a seller (GET request to show the form)
    Route::get('/admin/create-seller', [SellerController::class, 'create'])->name('admin.create-seller');

    // Admin posts the form to store the seller
    Route::post('/admin/create-seller', [SellerController::class, 'store'])->name('admin.store-seller');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
});


// Route to the welcome page (for non-authenticated users or as a home page)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Add this route to handle logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');