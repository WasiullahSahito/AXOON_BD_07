<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\UserDashboardController as UserDashboardController;
use App\Http\Controllers\Auth\LoginController;

// Corrected namespace

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/product_detail', function () {
    return view('product_detail');
})->name('product_detail');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', AdminProductController::class);
    // Removed missing AdminUserController
    Route::resource('orders', AdminOrderController::class)->only('index', 'show');
    Route::put('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::get('reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
});

// User Dashboard Routes
Route::middleware('auth')->group(function () {
    // Corrected controller namespace
    Route::get('/myaccount', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/myaccount/orders', [UserDashboardController::class, 'orders'])->name('user.orders');
    Route::get('/myaccount/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
    Route::put('/myaccount/profile', [UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/myaccount/orders/{order}', [UserDashboardController::class, 'showOrder'])
    ->name('user.orders.show');
    Route::get('/myaccount/password', [UserDashboardController::class, 'password'])->name('user.profile.password');
    Route::put('/myaccount/password', [UserDashboardController::class, 'updatePassword'])->name('user.profile.update-password ');

// routes/web.php

Route::post('/process-payment', [CheckoutController::class, 'processPayment'])->name('process.payment');
Route::post('/confirm-payment', [CheckoutController::class, 'confirmPayment'])->name('confirm.payment');
Route::get('/thankyou/{order}', function (Order $order) {
    return view('thankyou', compact('order'));
})->name('thankyou');


});
