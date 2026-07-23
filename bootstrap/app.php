<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->report(function (\Throwable $e) {
            if (! $e instanceof \Illuminate\Validation\ValidationException) {
                \Illuminate\Support\Facades\Log::error('Unhandled exception', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);
            }
        });

        $exceptions->render(function (App\Exceptions\InsufficientFundsException $e) {
            return back()->with('error', $e->getMessage());
        });
        $exceptions->render(function (App\Exceptions\InsufficientSharesException $e) {
            return back()->with('error', $e->getMessage());
        });
        $exceptions->render(function (App\Exceptions\DormantAccountException $e) {
            return back()->with('error', $e->getMessage());
        });
        $exceptions->render(function (App\Exceptions\InactiveLoanProductException $e) {
            return back()->with('error', $e->getMessage());
        });
        $exceptions->render(function (App\Exceptions\InactiveBranchException $e) {
            return back()->with('error', $e->getMessage());
        });
    })->create();
