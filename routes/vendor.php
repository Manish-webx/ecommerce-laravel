<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;

Route::get('/dashboard', [VendorController::class,'dashboard'])->name('dashboard');

Route::get('/profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('/update', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/update/password', [VendorProfileController::class, 'updatePassword'])->name('profile.password.update');

// Shop profile route

// Vendor Routes
Route::resource('/shop-profile', VendorShopProfileController::class);

// Product Routes
Route::get('product_subcategories', [VendorProductController::class, 'productSubCategories'])->name('getproduct-subcategories');
Route::get('product_childcategories', [VendorProductController::class, 'productChildCategories'])->name('getproduct-childcategories');
Route::put('products/change-status', [VendorProductController::class, 'changeStatus'])->name('products.change-status');
Route::resource('/products', VendorProductController::class);

Route::resource('product-image-gallery', VendorProductImageGalleryController::class);

// Products Variant Routes
Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', VendorProductVariantController::class);

// Products Variant Items Route
Route::get('products-variant-items/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])->name('products-variant-items.index');
Route::get('products-variant-items/create/{productId}/{variantId}', [VendorProductVariantItemController::class, 'create'])->name('products-variant-items.create');
Route::post('products-variant-items', [VendorProductVariantItemController::class, 'store'])->name('products-variant-items.store');
Route::get('products-variant-items-edit/{variantItemId}', [VendorProductVariantItemController::class, 'edit'])->name('products-variant-items.edit');
Route::put('products-variant-items-update/{variantItemId}', [VendorProductVariantItemController::class, 'update'])->name('products-variant-items.update');
Route::put('products-variant-items/change-status', [VendorProductVariantItemController::class, 'changeStatus'])->name('products-variant-items.change-status');
Route::delete('products-variant-items/{variantItemId}/destroy', [VendorProductVariantItemController::class, 'destroy'])->name('products-variant-items.destroy');

//Order Routes
Route::get('order', [VendorOrderController::class, 'index'])->name('order.index');
Route::get('order/show/{id}', [VendorOrderController::class, 'show'])->name('order.show');
Route::post('order/status/{id}', [VendorOrderController::class, 'orderStatus'])->name('order.status');

