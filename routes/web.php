<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;

Route::get('/', function () {
    return view('welcome');
});

// Các Route Demo
Route::get('/demo', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
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