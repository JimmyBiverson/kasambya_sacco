<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Fix REQUEST_URI for subdirectory deployment via root .htaccess rewrite
if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['SCRIPT_NAME'])) {
    $dir = dirname($_SERVER['SCRIPT_NAME']);
    if ($dir !== '/' && $dir !== '\\') {
        $parentDir = dirname($dir);
        $uri = $_SERVER['REQUEST_URI'];
        if (str_starts_with($uri, $parentDir) && !str_starts_with($uri, $dir)) {
            $_SERVER['REQUEST_URI'] = $dir . substr($uri, strlen($parentDir));
        }
    }
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle($request = Request::capture());

$response->send();
$kernel->terminate($request, $response);
