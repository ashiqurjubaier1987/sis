<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Illuminate\Foundation\Configuration\Exceptions $exceptions) {
        $exceptions->shouldRenderJsonWhen(function (Illuminate\Http\Request $request, Throwable $e) {
            return $request->expectsJson() || $request->is('api/*');
        });

        $exceptions->render(function (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Response::api(null, 'Resource not found', 404, true);
        });

        $exceptions->render(function (Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            return Response::api(null, 'Resource not found', 404, true);
        });
    })->create();
