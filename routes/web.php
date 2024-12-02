<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Client\UserController as ClientUserController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsAdmin;
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
Route::get('/search', [HomeController::class, 'search'])->name('search.product');


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/shop-detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::get('/shop-list', [HomeController::class, 'list'])->name('list');
Route::get('/shop-list/sort', [HomeController::class, 'list'])->name('shop.sort');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update-quantity/{item}', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
Route::delete('/cart/remove-item/{item}', [CartController::class, 'removeItem'])->name('cart.remove-item');



Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('dashboard', [ClientUserController::class, 'index'])->name('dashboard');

    Route::get('edit-profile', [ClientUserController::class, 'editProfile'])->name('profile.edit');
    Route::post('update-profile', [ClientUserController::class, 'updateProfile'])->name('profile.update');

    Route::get('change-password', [ClientUserController::class, 'changePasswordForm'])->name('change.password');
    Route::post('update-password', [ClientUserController::class, 'updatePassword'])->name('update.password');
});

Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::post('ban-user', [AdminUserController::class, 'ban'])->name('admin.ban-user');
    Route::post('unban-user', [AdminUserController::class, 'unban'])->name('admin.unban-user');
    Route::post('admin/users/{user}/toggle', [AdminUserController::class, 'toggleUserStatus'])->name('admin.users.toggle');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('attributes.values', AttributeValueController::class);
    Route::resource('products.variants', ProductVariantController::class);
});

