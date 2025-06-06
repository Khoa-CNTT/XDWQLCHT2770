<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Không thêm KhachHangMiddle vào middleware toàn cục
        // $middleware->append(\App\Http\Middleware\KhachHangMiddle::class);

        // Đăng ký alias để sử dụng trong route
        $middleware->alias([
            'khachhang' => \App\Http\Middleware\KhachHangMiddle::class,
            'admin' => \App\Http\Middleware\NhanVienMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();