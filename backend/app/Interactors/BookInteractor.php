<?php

namespace App\Interactors;

use App\Repositories\BookRepositoryI;
use Illuminate\Support\Collection;

class BookInteractor implements BookInteractorI
{
    public function __construct(private BookRepositoryI $bookRepository)
    {
    }

    public function getBooksByGenre(
        string $genreId,
        int $pagitation,
        int $quantity
    ): Collection {
        return $this->bookRepository->getBooksByGenre(
            $genreId,
            $pagitation,
            $quantity
        );
    }

    public function getBooksByWhitelist(
        string $userId,
        int $pagitation,
        int $quantity
    ): Collection {
        return $this->bookRepository->getBooksByWhitelist(
            $userId,
            $pagitation,
            $quantity
        );
    }

    public function getBooksPromotionByGenre(
        string $genreId,
        int $pagitation,
        int $quantity
    ): Collection {
        return $this->bookRepository->getBooksPromotionByGenre(
            $genreId,
            $pagitation,
            $quantity
        );
    }

    public function getBooksByPromotion(
        int $pagitation,
        int $quantity
    ): Collection {
        $this->bookRepository->getBooksByPromotion($pagitation, $quantity);
    }

    public function create(array $book): Collection
    {
        $this->bookRepository->create($book);
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
