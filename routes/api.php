<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceProductController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PrdouctDetailsController;
use App\Http\Controllers\PrdouctReviewController;
use App\Http\Controllers\ProdoductSliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductWisheController;
use App\Http\Controllers\UserController;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/register', [UserController::class, 'userRegister'])->name('userRegister');
// Route::get('/register',[UserController::class,'userRegister'])->name('userRegister');
Route::post('/login', [UserController::class, 'userLogin'])->name('userLogin');

// Route::get('/email_otp',[UserController::class,'emailOTP'])->name('email_otp');
// Route::get('/verify_otp',[UserController::class,'verifyOTP'])->name('verify_otp');// In routes/api.php

// Route::post('/reset-password', [UserController::class, 'userResetPassword'])->middleware('reset-password');
Route::get('/email_otp', [UserController::class, 'emailOTP'])->name('email_otp');

// In routes/api.php
Route::middleware('verify.token')->group(function () {

    Route::get('/verify_otp', [UserController::class, 'verifyOTP'])->name('verify_otp'); // In routes/api.php
    Route::post('/reset_password', [UserController::class, 'userResetPassword'])->name('reset_password');
});



// Brand Route

Route::get('/brands',[BrandController::class, 'allBrand'])->name('brands');
Route::post('/brand_create', [BrandController::class, 'storeBrand'])->name('brand_create');



// Category Route

Route::get('/categories', [CategoryController::class, 'allCategory'])->name('categories');
Route::post('/category_create', [CategoryController::class, 'storelCategory'])->name('category_create');


// Customer Profile Route

Route::post('/customer_profile', [CustomerController::class, 'customerProfile'])->name('customer_profile');
// Route::get('/customer_profile_update', [UserController::class, 'customerProfileUpdate'])->name('customer_profile_update');



// product route

Route::get('/products', [ProductController::class, 'allProduct'])->name('products');
Route::post('/product_create', [ProductController::class, 'storeProduct'])->name('product_create');


// product details route
Route::get('/product_details', [PrdouctDetailsController::class, 'allPrdouctDetail'])->name('product_details');
Route::post('/product_detail_create', [PrdouctDetailsController::class, 'storePrdouctDetail'])->name('product_detail_create');

// product slider route
Route::get('/product_sliders', [ProdoductSliderController::class, 'allProductSlider'])->name('product_slider');
Route::post('/product_slider_create', [ProdoductSliderController::class, 'storeProductSlider'])->name('product_slider_create');


//product review route
Route::get('/product_reviews', [PrdouctReviewController::class, 'allProductReview'])->name('product_review');
Route::post('/product_review_create', [PrdouctReviewController::class, 'storeProductReview'])->name('product_review_create');




// product wishelist route
Route::get('/product_wishlists', [ProductWisheController::class, 'allProductWishlist'])->name('product_wishlist');
Route::post('/product_wishlist_create', [ProductWisheController::class, 'storeProductWishlist'])->name('product_wishlist_create');




// product cart route
Route::get('/product_carts', [ProductWisheController::class, 'allProductCart'])->name('product_cart');
Route::post('/product_cart_create', [ProductWisheController::class, 'storeProductCart'])->name('product_cart_create');


// policy route

Route::get('/privacy_policy', [PolicyController::class, 'allPolicy'])->name('privacy_policy');
Route::post('/terms_condition', [PolicyController::class, 'storePolicy'])->name('terms_condition');




// invoice route
Route::get('/invoices', [InvoiceController::class, 'allInvoice'])->name('invoice');
Route::post('/invoice_create', [InvoiceController::class, 'storeInvoice'])->name('invoice_create');



// invoice product
Route::get('/invoice_products', [InvoiceProductController::class, 'allInvoiceProduct'])->name('invoice_product');
Route::post('/invoice_product_create', [InvoiceProductController::class, 'storeInvoiceProduct'])->name('invoice_product_create');

