<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\EnsureUserIsAuth;
use App\Http\Middleware\EnsureIsAdmin;
use App\Models\Genre;
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

Route::middleware(EnsureUserIsAuth::class)->group(function () {
    Route::prefix("carts")
        ->name("carts.")
        ->group(function () {
            Route::get("/count", [CartController::class, "count"]);
            Route::get("/books", [CartController::class, "books"]);
            Route::post("/books", [CartController::class, "create"]);
            Route::put("/books/{book}", [CartController::class, "update"]);
        });

    Route::prefix("books")
        ->name("books.")
        ->group(function () {
            Route::get("/{pagination}/{quantity}", [
                BookController::class,
                "getRandomBooks",
            ]);

            Route::get("/genre/{genre}", [
                BookController::class,
                "getBooksByGenre",
            ]);

            Route::post("/", [BookController::class, "store"]);
        });

    Route::prefix("genres")
        ->name("genres.")
        ->group(function () {
            Route::get("/", [GenreController::class, "list"]);
            Route::get("/{genre}", [GenreController::class, "getById"]);

            Route::post("/", [GenreController::class, "store"])->can(
                "create",
                Genre::class
            );

            Route::put("/{genre}", [GenreController::class, "update"])->can(
                "update",
                "genre"
            );

            Route::put("/{genre}", [GenreController::class, "update"])->can(
                "delete",
                "genre"
            );
        });

    Route::prefix("notifications")
        ->name("notifications.")
        ->group(function () {
            Route::get("/", [NotificationController::class, "list"]);

            Route::put("/{notification}", [
                NotificationController::class,
                "read",
            ])->can("read", "notification");

            Route::delete("/{notification}", [
                NotificationController::class,
                "destroy",
            ])->can("delete", "notification");
        });
});
