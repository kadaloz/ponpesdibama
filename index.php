<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode
if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoload
require __DIR__.'/vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/bootstrap/app.php';

// ⬅️ Ini WAJIB agar Laravel tahu folder public ada di /public
$app->usePublicPath(__DIR__.'/public');

// Handle request
$app->handleRequest(Request::capture());