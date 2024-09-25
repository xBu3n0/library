<?php

namespace App\Interactors;

use App\Repositories\BookRepositoryI;
use Illuminate\Support\Collection;

class BookInteractor implements BookInteractorI
{
    public function __construct(private BookRepositoryI $bookRepository)
    {
    }

    public function getRandomBooks(int $pagination, int $quantity): Collection
    {
        return $this->bookRepository->getRandomBooks($pagination, $quantity);
    }

    public function getBooksByGenre(
        string $genreId,
        int $pagination,
        int $quantity
    ): Collection {
        return $this->bookRepository->getBooksByGenre(
            $genreId,
            $pagination,
            $quantity
        );
    }

    public function getBooksByWhitelist(
        string $userId,
        int $pagination,
        int $quantity
    ): Collection {
        return $this->bookRepository->getBooksByWhitelist(
            $userId,
            $pagination,
            $quantity
        );
    }

    public function getBooksPromotionByGenre(
        string $genreId,
        int $pagination,
        int $quantity
    ): Collection {
        return $this->bookRepository->getBooksPromotionByGenre(
            $genreId,
            $pagination,
            $quantity
        );
    }

    public function getBooksByPromotion(
        int $pagination,
        int $quantity
    ): Collection {
        $this->bookRepository->getBooksByPromotion($pagination, $quantity);
    }

    public function create(array $book): Collection
    {
        return $this->bookRepository->create($book);
    }

    public function update(array $bookId, array $book): void
    {
        $this->bookRepository->update($bookId, $book);
    }

    public function delete(array $bookId): void
    {
        $this->bookRepository->delete($bookId);
    }
}
