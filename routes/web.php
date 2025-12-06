<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');
Route::get('/products', [FrontendProductController::class, 'productsIndex'])->name('products.index');
Route::get('/product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');
Route::get('/product-view-list-type', [FrontendProductController::class, 'viewListType'])->name('product-view-list-type');

// Cart Routes
Route::get('/cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'cartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total', [CartController::class, 'sidebarProductTotal'])->name('cart.sidebar-product-total');

Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('calculate-coupon', [CartController::class, 'calculateCoupon'])->name('calculate-coupon');


Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('dashboard', [UserDashboardController::class, 'index']);
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('update', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('update/password', [UserProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Address Routes
    Route::resource('address', UserAddressController::class);

    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('create-address', [CheckoutController::class, 'createAddress'])->name('create-address');
    Route::post('submit-checkout', [CheckoutController::class, 'submitCheckout'])->name('submit-checkout');

    // Payment route
    Route::get('payment', [PaymentController::class, 'payment'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment-success');

    // Paypal Routes
    Route::get('/paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('/paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('/paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    // Stripe Routes
    Route::post('/stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('/stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('/stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');

    // Stripe Routes
    Route::post('/razorpay/payment', [PaymentController::class, 'payWithRazorpay'])->name('razorpay.payment');
    Route::get('/razorpay/success', [PaymentController::class, 'razorpaySuccess'])->name('razorpay.success');
    Route::get('/razorpay/cancel', [PaymentController::class, 'razorpayCancel'])->name('razorpay.cancel');

    //Order Routes
    Route::get('order', [UserOrderController::class, 'index'])->name('order.index');
    Route::get('order/show/{id}', [UserOrderController::class, 'show'])->name('order.show');
});
