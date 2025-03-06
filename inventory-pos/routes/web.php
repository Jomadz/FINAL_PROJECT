<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileImageController;

// Show the profile image upload form
Route::get('/profile', [ProfileImageController::class, 'showForm'])->name('profile.show');

// Handle the profile image upload
Route::post('/profile/upload', [ProfileImageController::class, 'upload'])->name('profile.upload');

Route::middleware(['auth'])->group(function () {
    // Route for the profile edit page
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
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