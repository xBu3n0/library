<?php

namespace App\Interactors;

use Illuminate\Support\Collection;

interface BookInteractorI
{
    public function getBooksByGenre(
        string $genreId,
        int $pagitation,
        int $quantity
    ): Collection;

    public function getBooksByWhitelist(
        string $userId,
        int $pagitation,
        int $quantity
    ): Collection;

    public function getBooksPromotionByGenre(
        string $genreId,
        int $pagitation,
        int $quantity
    ): Collection;

    public function getBooksByPromotion(
        int $pagitation,
        int $quantity
    ): Collection;

    public function create(array $book): Collection;

    public function update(array $bookId, array $book): void;

    public function delete(array $bookId): void;
}
