<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BorrowingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\UserController;
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
        Route::resource('purchases', PurchaseController::class);
        Route::resource('users', UserController::class);
    });


Route::get('/purchase/{id}/create', [PurchaseController::class, 'create'])->name('purchase.create');
Route::get('/purchase/{id}/store', [PurchaseController::class, 'store'])->name('purchase.store')->middleware('auth');
Route::get('/purchase/success', [PurchaseController::class, 'success'])->name('purchase.success');
Route::get('/purchase/success', [PurchaseController::class, 'success'])->name('purchase.success');

Route::get('/books/all', [BookController::class, 'show'])->name('books.all');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
