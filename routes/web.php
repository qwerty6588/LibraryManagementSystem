<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserCabinetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Главная
Route::get('/', function () {
    return view('welcome');
});

// -------------------- Админка --------------------
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'lang', 'admin'])
    ->group(function () {
        Route::resource('books', BookController::class);
        Route::resource('authors', AuthorController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);

        // Управление заказами
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

// -------------------- Кабинет пользователя --------------------
Route::prefix('cabinet')
    ->name('user.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('orders', [UserCabinetController::class, 'index'])->name('orders');
        Route::get('orders/{id}', [UserCabinetController::class, 'show'])->name('orders.show');
    });

// -------------------- Корзина (Frontend) --------------------
Route::prefix('cart')
    ->name('cart.')
    ->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
        Route::post('/update/{id}', [CartController::class, 'update'])->name('update');
        Route::get('/remove/{id}', [CartController::class, 'remove'])->name('remove');
        Route::get('/clear', [CartController::class, 'clear'])->name('clear');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::get('/success', [CartController::class, 'success'])->name('success');
    });

Route::get('/books/all', [BookController::class, 'show'])->name('books.all');

Auth::routes();
