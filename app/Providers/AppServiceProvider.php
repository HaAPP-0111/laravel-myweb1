<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
// BỔ SUNG: Khai báo thư viện Paginator theo đúng ảnh hướng dẫn
=======
// Khai báo thư viện Paginator để cấu hình phân trang
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        // BỔ SUNG: Cấu hình bắt buộc để thanh phân trang hiển thị chuẩn Bootstrap 5
=======
        // Cấu hình hiển thị giao diện phân trang theo Bootstrap 5
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
        Paginator::useBootstrapFive();
    }
}