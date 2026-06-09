<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Khai báo thư viện Paginator để cấu hình phân trang
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
        // Cấu hình hiển thị giao diện phân trang theo Bootstrap 5
        Paginator::useBootstrapFive();
    }
}