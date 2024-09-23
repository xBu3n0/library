<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . "/../routes/web.php",
        commands: __DIR__ . "/../routes/console.php",
        api: __DIR__ . "/../routes/api.php",
        health: "/up"
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(StartSession::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $e) {
            return response(
                status: $e->status,
                content: [
                    "status" => $e->status,
                    "data" => null,
                    "errors" => $e->errors(),
                ]
            );
        });

        $exceptions->render(function (UnauthorizedException $e) {
            return response(
                status: 401,
                content: [
                    "status" => 401,
                    "data" => null,
                    "errors" => ["auth" => ["Unauthenticated"]],
                ]
            );
        });

        $exceptions->render(function (ItemNotFoundException $e) {
            return response(
                status: 404,
                content: [
                    "status" => 404,
                    "data" => null,
                    "errors" => ["message" => "Item not exists"],
                ]
            );
        });
    })
    ->create();
