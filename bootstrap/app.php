<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Enumerators\Exceptions as ExceptionsEnum;
use Illuminate\Http\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (\Exception $exception) {
            return response()->json([
                'shortMessage' => ExceptionsEnum::NOT_FOUND->value,
                'message' => __('exceptions.' . ExceptionsEnum::NOT_FOUND->value),
                'httpCode' => Response::HTTP_NOT_FOUND,
                'description' => $exception->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        });
    })->create();
