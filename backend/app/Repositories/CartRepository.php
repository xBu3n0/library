<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Book;
use App\Models\UserWhitelist;
use Illuminate\Database\Eloquent\Collection;

class CartRepository implements CartRepositoryI
{
    public function getCount(string $userId): int
    {
        return Cart::query()->where("user_id", $userId)->sum("quantity");
    }

    public function getBooks(string $userId): Collection
    {
        return Cart::query()->with("book")->where("user_id", $userId)->get();
    }

    public function addBook(string $userId, string $bookId, int $quantity): void
    {
        $cartRow = new Cart([
            "user_id" => $userId,
            "book_id" => $bookId,
            "quantity" => $quantity,
        ]);

        $cartRow->save();
    }

    public function updateBookQuantity(
        string $userId,
        string $bookId,
        int $quantity
    ): void {
        Cart::query()
            ->where(["user_id" => $userId, "book_id" => $bookId])
            ->update(["quantity" => $quantity]);
    }

    public function removeBook(string $userId, string $bookId): void
    {
        Cart::query()
            ->where(["user_id" => $userId, "book_id" => $bookId])
            ->delete();
    }
}
