<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\FooterMenuController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/category/{slug}', [ShopController::class, 'category'])->name('category');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order-confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/my-account', [AuthController::class, 'myAccount'])->name('my-account')->middleware('auth');
Route::put('/my-account', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::put('/my-account/password', [AuthController::class, 'updatePassword'])->name('profile.password.update')->middleware('auth');
Route::get('/my-orders', [AuthController::class, 'myOrders'])->name('my-orders')->middleware('auth');
Route::get('/order/{order}', [AuthController::class, 'orderDetail'])->name('order-detail')->middleware('auth');
Route::get('/my-addresses', [AuthController::class, 'myAddresses'])->name('my-addresses')->middleware('auth');
Route::post('/my-addresses', [AuthController::class, 'updateAddress'])->name('my-addresses.update')->middleware('auth');
Route::get('/wishlist', function () {
    return view('frontend.wishlist');
})->name('wishlist')->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [DashboardController::class, 'login'])->name('login');
    Route::post('/login', [DashboardController::class, 'loginPost'])->name('login.post');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('users', UserController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('pages', AdminPageController::class);
        Route::resource('contacts', AdminContactController::class);
        Route::resource('footer-menu', FooterMenuController::class);

        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
        Route::put('/settings', [SettingController::class, 'store'])->name('settings.update');

        Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    });
});
