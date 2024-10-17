<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Dashboard\OrderController as DashboardOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/list', [ProductController::class, 'list'])->name('list');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('delete');

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/list', [DashboardOrderController::class, 'index'])->name('list');
        Route::post('/confirmed/{id}', [DashboardOrderController::class, 'confirmed'])->name('confirmed');
        Route::post('/shipped/{id}', [DashboardOrderController::class, 'shipped'])->name('shipped');
        Route::post('/delivered/{id}', [DashboardOrderController::class, 'delivered'])->name('delivered');
        Route::post('/returned/{id}', [DashboardOrderController::class, 'returned'])->name('returned');
        Route::post('/canceled/{id}', [DashboardOrderController::class, 'canceled'])->name('canceled');
    });
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/show-register', [AuthController::class, 'showRegister'])->name('show-register');
    Route::get('/show-login', [AuthController::class, 'showLogin'])->name('show-login');
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/detail/{id}', [ProductController::class, 'show'])->name('show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::group(['prefix' => 'basket', 'as' => 'basket.'], function () {
        Route::get('/index', [BasketController::class, 'index'])->name('index');
        Route::post('/store', [BasketController::class, 'store'])->name('store');
        Route::post('/delete', [BasketController::class, 'delete'])->name('delete');
        Route::post('/decrease', [BasketController::class, 'decrease'])->name('decrease');
        Route::get('/checkout', [BasketController::class, 'checkout'])->name('checkout');
    });

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::post('/add', [OrderController::class, 'add'])->name('add');
        Route::get('/index', [OrderController::class, 'my_orders'])->name('index');
        Route::get('/detail/{id}', [OrderController::class, 'show_order_detail'])->name('detail');
        Route::post('/cancel/{id}', [OrderController::class, 'cancel_order'])->name('cancel');
    });


});
