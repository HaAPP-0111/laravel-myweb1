<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kiểm tra xem vai trò của user đăng nhập có nằm trong danh sách được phép không
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, "Bạn không có quyền truy cập");
        }

        return $next($request);
    }
}
