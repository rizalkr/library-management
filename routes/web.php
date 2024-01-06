<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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

 Route::get('/',[PublicController::class,'index']);

// Login register
Route::middleware('only_guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerProccess'])->name('register');
});

// Succesfuly Login
Route::middleware('auth')->group(function () {
    Route::get('profile', [UserController::class, 'profile'])->middleware('only_client')->name('profile');
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('only_admin')->name('dashboard');
    // Books
    Route::get('books', [BookController::class, 'index'])->name('home');
    Route::get('book/add', [BookController::class, 'add'])->name('books.add');
    Route::post('book/store', [BookController::class, 'store'])->name('books.store');
    Route::get('book/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('book/update/{id}', [BookController::class, 'update'])->name('books.update');
    Route::get('book/delete/{id}', [BookController::class, 'delete'])->name('books.delete');
    Route::get('book/destroy/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('book/deleted/', [BookController::class, 'deletedBooks'])->name('books.deleted');
    Route::get('book/restore/{id}', [BookController::class, 'restore'])->name('books.restore');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::post('category/add', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/deleted', [CategoryController::class, 'deletedCategory'])->name('category.deleted-list');
    Route::get('/category/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');

    // User
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('/registered-users', [UserController::class, 'registeredUser']);
    Route::get('/user-detail/{username}', [UserController::class, 'show']);
    Route::get('/user-approve/{username}', [UserController::class, 'approve']);
    Route::get('/user-delete/{username}', [UserController::class, 'delete']);
    Route::get('/user-destroy/{username}', [UserController::class, 'destroy']);
    Route::get('/user-deleted', [userController::class, 'deletedUsers']);
    Route::get('/user-restore/{username}', [userController::class, 'restore']);
    // Rent

    Route::get('/book-rent',[BookRentController::class, 'index']);
    Route::post('/book-rent',[BookRentController::class, 'store']);

    Route::get('book-return',[BookRentController::class, 'returnBook']);
    Route::post('book-return',[BookRentController::class, 'saveReturnBook']);

    Route::get('rent-log', [RentLogController::class, 'index'])->name('rent-log');
    Route::get('logout', [AuthController::class, 'logout']);
});
