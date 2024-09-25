<?php

namespace App\Interactors;

use App\Repositories\CartRepositoryI;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CartInteractor implements CartInteractorI
{
    public function __construct(private CartRepositoryI $cartRepository)
    {
    }

    private function clearCache(string $userId): void
    {
        Cache::forget("cart:count:{$userId}");
        Cache::forget("cart:{$userId}:books");
    }

    public function getCount(string $userId): int
    {
        $count = Cache::remember(
            "cart:count:{$userId}",
            600,
            fn() => $this->cartRepository->getCount($userId)
        );

        return $count;
    }

    public function getBooks(string $userId): Collection
    {
        $books = Cache::remember(
            "cart:{$userId}:books",
            600,
            fn() => $this->cartRepository->getBooks($userId)
        );

        return $books;
    }

    public function addBook(string $userId, string $bookId, int $quantity): void
    {
        $this->clearCache($userId);

        $this->cartRepository->addBook($userId, $bookId, $quantity);
    }

    public function updateBookQuantity(
        string $userId,
        string $bookId,
        int $quantity
    ): void {
        $this->clearCache($userId);

        $this->cartRepository->updateBookQuantity($userId, $bookId, $quantity);
    }

    public function removeBook(string $userId, string $bookId): void
    {
        $this->clearCache($userId);

        $this->cartRepository->removeBook($userId, $bookId);
    }
}
