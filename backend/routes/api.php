<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\EnsureUserIsAuth;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")
    ->name("auth.")
    ->group(function () {
        Route::post("/register", [AuthController::class, "register"])->name(
            "register"
        );
        Route::post("/login", [AuthController::class, "login"])->name("login");
        Route::get("/", [AuthController::class, "isAuth"])->name("isAuth");
        Route::post("/logout", [AuthController::class, "logout"])->name(
            "logout"
        );
    });

/**
Route::prefix("books")
    ->name("books.")
    ->group(function () {});
*/

Route::resource("books", BookController::class);

Route::middleware(EnsureUserIsAuth::class)->group(function () {
    Route::prefix("carts")
        ->name("carts.")
        ->group(function () {
            Route::get("/count", [CartController::class, "count"]);
            Route::get("/books", [CartController::class, "books"]);
            Route::post("/books", [CartController::class, "create"]);
            Route::put("/{book}", [CartController::class, "update"]);
        });

    Route::prefix("notifications")
        ->name("notifications.")
        ->group(function () {
            Route::get("/", [NotificationController::class, "list"]);
            Route::put("/{notification}", [
                NotificationController::class,
                "read",
            ]);
            Route::delete("/{notification}", [
                NotificationController::class,
                "destroy",
            ]);
        });
});
