<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// --- Giao diện người dùng công khai ---
Route::get('/', function () {
    return view('welcome');
});

// --- Các Route Demo / Test ---
Route::get('/demo', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
Route::get('/demo6/{param1}/{param2}', [DemoController::class, 'index6']);

Route::get('/test1', [ProductController::class, 'test1']);
Route::get('/test2', [ProductController::class, 'test2']);


// --- PHÂN HỆ ADMIN (QUẢN TRỊ) ---
// Gom tất cả vào prefix 'admin' và đặt tên chung là 'admin.' để đồng bộ với View
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Tự động chuyển hướng từ /admin sang /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Authentication Routes
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('/forgotpass', [AuthController::class, 'forgotPassword'])->name('forgotpass');
    Route::post('/forgotpass', [AuthController::class, 'postForgotpassword'])->name('forgotpass.post');

    // Protected Admin Routes (Yêu cầu đăng nhập)
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD - Resource route
        Route::middleware('roles:1')->group(function () {
            // Hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
            Route::get('trash/categories', [CategoryController::class, 'trash'])->name('categories.trash');
            // Khôi phục
            Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
            // Xóa vĩnh viễn
            Route::delete('categories/{id}/forcedelete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

            Route::resource('categories', CategoryController::class);
            Route::resource('brands', BrandController::class);
            Route::resource('users', UserController::class);
            Route::resource('products', ProductController::class)->except(['index']);
            Route::delete('products/images/{id}', [ProductController::class, 'deleteImage'])->name('products.images.delete');
            Route::resource('posts', PostController::class);
        });

        // Cả Admin (role 1) và Nhân viên (role 2) đều xem được danh sách sản phẩm
        Route::resource('products', ProductController::class)->only(['index'])->middleware('roles:1,2');
    });
});