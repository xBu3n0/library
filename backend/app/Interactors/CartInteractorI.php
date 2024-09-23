<?php

namespace App\Interactors;

use Illuminate\Support\Collection;

interface CartInteractorI
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
