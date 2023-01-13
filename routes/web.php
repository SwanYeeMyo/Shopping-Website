<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\userController;
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
//user
//

Route::get('/', [userController::class, 'index'])->name('user#home');
Route::get('user/products', [userController::class, 'product'])->name('user#products');
Route::get('/product/filter/{id}', [userController::class, 'filter'])->name('user#filter');
Route::get('/product/details/{id}', [userController::class, 'details'])->name('user#detail');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart/create', [userController::class, 'createCart'])->name('user#cartCreate');
    Route::get('/cart', [userController::class, 'cart'])->name('user#cart');
    Route::get('/history', [usercontroller::class, 'history'])->name('user#history');
    Route::get('/cart/delete', [userController::class, 'deleteCart'])->name('user#cartDelete');
    Route::get('/cart/deleteAll', [userController::class, 'cartDeleteAll'])->name('user#cartDAll');
    Route::get('/ajax/order', [AjaxController::class, 'order'])->name('user#order');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::middleware(['admin_auth'])->group(function () {
        Route::get('/profile', [AdminController::class, 'index'])->name('admin#profile');
        Route::post('/Update', [AdminController::class, 'update'])->name('admin#update');
        Route::post('/ChangePassword', [AdminController::class, 'changePassword'])->name('admin#chgPassword');
        Route::get('/Products', [ProductController::class, 'index'])->name('admin#product');
//product Create Edit adn Delete
        Route::post('/Products/create', [ProductController::class, 'create'])->name('product#productCreate');
        Route::post('/Products/delete', [ProductController::class, 'delete'])->name('product#delete');
        Route::get('/Products/edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
        Route::post('/Products/update', [ProductController::class, 'update'])->name('product#update');
//end
//category-creat
        Route::get('/Category', [CategoryController::class, 'index'])->name('admin#category');
        Route::post('/categorydCreate', [CategoryController::class, 'create'])->name('admin#createCategory');
        Route::post('/category/delete', [CategoryController::class, 'delete'])->name('admin#deleteCategory');
        Route::post('/category/edit', [CategoryController::class, 'Edit'])->name('admin#editCategory');
        Route::post('/category/update', [CategoryController::class, 'update'])->name('admin#updateCategory');
//orders
        Route::get('/orders', [OrderListController::class, 'index'])->name('admin#orderList');
        //users
        Route::get('users', [AdminController::class, 'users'])->name('admin#users');
    });

    //admin

    //end

});
