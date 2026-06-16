<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
=======
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
<<<<<<< HEAD
use App\Http\Controllers\Admin\CategoryController;

// --- Giao diện người dùng công khai ---
=======

>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// --- Các Route Demo / Test ---
=======
// Các Route Demo
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
Route::get('/demo', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
<<<<<<< HEAD
Route::get('/demo6/{param1}/{param2}', [DemoController::class, 'index6']);

Route::get('/test1', [ProductController::class, 'test1']);
Route::get('/test2', [ProductController::class, 'test2']);


// --- PHÂN HỆ ADMIN (QUẢN TRỊ) ---
// Gom tất cả vào prefix 'admin' và đặt tên chung là 'admin.' để đồng bộ với View
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Trang chủ Admin (Dashboard)
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('home');

    // Các Route Resource (Đầy đủ chức năng hiển thị danh sách, thêm, xóa cho cả 5 phần)
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('posts', PostController::class);
    
});
=======
Route::get('/demo6/{parram1}/{parram2}', [DemoController::class, 'index6']);

// ==========================================
// Các Route cấu trúc lại theo nhóm Admin (Theo tài liệu B.1)
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Trang Dashboard chính của Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Các Route Resource cho Admin quản lý
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('posts', PostController::class);
    
});
// ==========================================

// Các Route Test chuyển hướng trong ProductController
Route::get('test1', [ProductController::class, 'test1']);
Route::get('test2', [ProductController::class, 'test2']);
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
