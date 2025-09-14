<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\UserCabinetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'lang', 'admin'])
    ->group(function () {
        Route::resource('books', BookController::class);
        Route::resource('authors', AuthorController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);

 /*       Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');*/

        Route::get('/purchases', [CartController::class, 'purchases'])->name('purchases');
 /*       Route::get('/purchase/{id}/create', [PurchaseController::class, 'create'])->name('purchase.create');
        Route::post('/purchase/{id}/store', [PurchaseController::class, 'store'])->name('purchase.store');*/

    });


Route::get('/purchases', [CartController::class, 'purchases'])->name('admin.purchases');


Route::prefix('cabinet')
    ->name('user.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('orders', [UserCabinetController::class, 'index'])->name('orders');
        Route::get('orders/{id}', [UserCabinetController::class, 'show'])->name('orders.show');
    });


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

