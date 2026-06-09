<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// BỔ SUNG: Khai báo thư viện Paginator theo đúng ảnh hướng dẫn
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
        // BỔ SUNG: Cấu hình bắt buộc để thanh phân trang hiển thị chuẩn Bootstrap 5
        Paginator::useBootstrapFive();
    }
}