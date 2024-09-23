<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CartRepositoryI
{
    public function getCount(string $userId): int;
    public function getBooks(string $userId): Collection;
    public function addBook(
        string $userId,
        string $bookId,
        int $quantity
    ): void;
    public function updateBookQuantity(
        string $userId,
        string $bookId,
        int $quantity
    ): void;
    public function removeBook(string $userId, string $bookId): void;
}
