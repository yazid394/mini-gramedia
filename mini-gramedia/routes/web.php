<?php

use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionPackageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/kategori-buku/{id?}', [HomeController::class, 'byCategory'])->name('books.category');

// kelompok root yang boleh di akses nya setelah login
Route::middleware(['IsLoggedIn'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // prefix untuk mengelompokkan route admin yang path nya diawali dengan / admnin
    // seluruh route pada kelompok ini akan memiliki nama route diambl dengan admin.
    // contoh : admin.dashboard
    Route::prefix('admin')->name('admin.')->middleware('IsAdmin')->group(function() {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('book-categories', BookCategoryController::class);
        Route::resource('subscription-packages', SubscriptionPackageController::class);
        Route::resource('books', BookController::class);


        // resource route untuk mengelola data kategori buku yang otomatis membuat semua method crud
        Route::resource('book-categories', BookCategoryController::class);

        Route::resource('subscription-packages', SubscriptionPackageController::class);
    });
});

// kelompok root yangh boleh di akses sebelum login
Route::middleware(['IsGuest'])->group(function () {
    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', [UserController::class, 'register'])->name('register.store')->middleware('throttle:5, 1');

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [UserController::class, 'login'])->name('login.store')->middleware('throttle:5, 1');
});
