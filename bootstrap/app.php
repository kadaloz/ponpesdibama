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
    ->withMiddleware(function (Middleware $middleware): void {
        // Middleware global yang diterapkan ke setiap permintaan web
        $middleware->web(append: [
            // Contoh middleware yang mungkin ada di sini secara default atau Anda tambahkan
            // \App\Http\Middleware\TrustProxies::class,
            // \Illuminate\Http\Middleware\HandleCors::class,
            // \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            // \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // \App\Http\Middleware\VerifyCsrfToken::class,
            // \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        // Alias untuk middleware rute yang dapat digunakan pada definisi rute
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class, // DIKOREKSI: 'Middlewares' menjadi 'Middleware'
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class, // DIKOREKSI: 'Middlewares' menjadi 'Middleware'
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class, // DIKOREKSI: 'Middlewares' menjadi 'Middleware'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Konfigurasi penanganan pengecualian (exceptions) di sini
        // Misalnya, melaporkan error tertentu atau merender halaman error kustom
    })->create();

