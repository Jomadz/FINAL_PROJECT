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
use App\Http\Controllers\POSController;
use App\Http\Controllers\SellerActivityController;



// Route to display seller activities
Route::get('/admin/seller-activities', [SellerActivityController::class, 'index'])->name('admin.seller-activities');
// Route for the POS interface
Route::get('/pos', [POSController::class, 'index'])->name('pos.index')->middleware('auth');
Route::post('/pos/sale', [POSController::class, 'store'])->name('pos.store')->middleware('auth');
//Route::get('/get-products/{categoryId}', [POSController::class, 'getProductsByCategory']);
Route::get('/pos/category/{id}/products', [POSController::class, 'showProductsByCategory']);
Route::post('/pos/store', [POSController::class, 'store']);
Route::post('/pos/submit-sale', [PosController::class, 'store']);

//sales routes
Route::middleware(['auth'])->group(function () {
    Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
   
    Route::post('/record-sale', [SaleController::class, 'processPayment']);
    
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

    Route::get('/sales/{id}/receipt', [SalesController::class, 'showReceipt'])->name('sales.receipt');

});Route::post('/record-sale', [SalesController::class, 'recordSale']);


//product routes
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('/get-products/{id}', [ProductController::class, 'getProductsByCategory']);
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

     // Admin can view the list of sellers
     Route::get('/admin/sellers', [SellerController::class, 'index'])->name('admin.sellers');

     // Route for updating a seller
    Route::put('/admin/sellers/{id}', [SellerController::class, 'update'])->name('admin.update-seller');

    Route::delete('/admin/sellers/{id}', [SellerController::class, 'destroy'])->name('admin.delete-seller');
    
Route::get('/admin/sellers/all', [SellerController::class, 'allSellers'])->name('admin.all-sellers');

Route::get('/admin/sellers/{id}/edit', [SellerController::class, 'edit'])->name('admin.edit-seller');



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
