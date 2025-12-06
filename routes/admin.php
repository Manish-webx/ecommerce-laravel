<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\HomepageSettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RazorpaySettingController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TransactionController;

Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');

// Slider routes

Route::resource('slider', SliderController::class);


// Category routes
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

// Sub Category routes
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

// Child Category routes
Route::put('childcategory/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('getsubcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

// Brand routes
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

// Vendor Routes
Route::resource('vendor-profile', AdminVendorProfileController::class);

// Products Routes
Route::get('product_subcategories', [ProductController::class, 'productSubCategories'])->name('getproduct-subcategories');
Route::get('product_childcategories', [ProductController::class, 'productChildCategories'])->name('getproduct-childcategories');
Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
Route::resource('product', ProductController::class);
Route::resource('product-image-gallery', ProductImageGalleryController::class);

// Products Variant Routes
Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);

// Products Variant Items Route
Route::get('products-variant-items/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-items.index');
Route::get('products-variant-items/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-items.create');
Route::post('products-variant-items', [ProductVariantItemController::class, 'store'])->name('products-variant-items.store');
Route::get('products-variant-items-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-items.edit');
Route::put('products-variant-items-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-items.update');
Route::put('products-variant-items/change-status', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-items.change-status');
Route::delete('products-variant-items/{variantItemId}/destroy', [ProductVariantItemController::class, 'destroy'])->name('products-variant-items.destroy');

// Seller Products Route
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pending'])->name('seller-pending-products.index');
Route::put('change-approved-status', [SellerProductController::class, 'changeApprovedStatus'])->name('change-approved-status');

// Flash Sale Routes
Route::get('flash-sale',[FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::put('flash-sale',[FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
Route::put('flash-sale/show-at-home/change-status', [FlashSaleController::class, 'showAtHomeStatus'])->name('flash-sale.show-at-home.change-status');
Route::put('flash-sale/change-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale.change-status');
Route::delete('flash-sale/{id}/destroy', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');

// coupon routes
Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupons.change-status');
Route::resource('coupons', CouponController::class);

// shipping rule routes
Route::put('shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
Route::resource('shipping-rule', ShippingRuleController::class);

// General Settings Routes
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('/general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update');

// Homepage Setting Routes
Route::get('/home-page-setting', [HomepageSettingController::class, 'index'])->name('home-page-setting');
Route::put('/update-popular-category', [HomepageSettingController::class, 'updatePopularCategorySection'])->name('update-popular-category');
Route::put('/update-popular-slider-one', [HomepageSettingController::class, 'updatePopularSliderSectionOne'])->name('update-popular-slider-one');
Route::put('/update-popular-slider-two', [HomepageSettingController::class, 'updatePopularSliderSectionTwo'])->name('update-popular-slider-two');
Route::put('/update-popular-slider-three', [HomepageSettingController::class, 'updatePopularSliderSectionThree'])->name('update-popular-slider-three');

// Payment Routes
Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::resource('paypal-setting', PaypalSettingController::class);
Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');
Route::put('razorpay-setting/{id}', [RazorpaySettingController::class, 'update'])->name('razorpay-setting.update');

// Order Routes
Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');
Route::get('order-payment-status', [OrderController::class, 'paymentOrderStatus'])->name('order.payment.status');
Route::get('pending-order', [OrderController::class, 'pendingOrder'])->name('pending.order');
Route::get('processed-order', [OrderController::class, 'processedOrder'])->name('processed.order');
Route::get('dropped-off-order', [OrderController::class, 'droppedOffOrder'])->name('dropped-off.order');
Route::get('shipped-order', [OrderController::class, 'shippedOrder'])->name('shipped.order');
Route::get('out-for-delivery-order', [OrderController::class, 'outForDeliveryOrder'])->name('out-for-delivery.order');
Route::get('delivered-order', [OrderController::class, 'deliveredOrder'])->name('delivered.order');
Route::get('canceled-order', [OrderController::class, 'canceledOrder'])->name('canceled.order');
Route::resource('order', OrderController::class);

//Transcation Routes
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');