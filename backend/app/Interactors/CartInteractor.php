<?php

namespace App\Interactors;

use App\Repositories\CartRepositoryI;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

class CartInteractor implements CartInteractorI
{
    public function __construct(private CartRepositoryI $cartRepository)
    {
    }

    private function clearRedis(string $userId): void
    {
        Redis::hdel("cart:count", $userId);

        foreach (Redis::hkeys("cart:{$userId}:books") as $k) {
            Redis::hdel(
                "cart:{$userId}:books",
                Redis::hkeys("cart:{$userId}:books")
            );
        }
    }

    public function getCount(string $userId): int
    {
        $count = Redis::hget("cart:count", $userId);

        if ($count === false) {
            $count = $this->cartRepository->getCount($userId);

            Redis::hset("cart:count", $userId, $count);
        }

        return $count;
    }

    public function getBooks(string $userId): Collection
    {
        $books = Redis::hgetall("cart:{$userId}:books");

        if ($books) {
            dd($books);
            return array_map(fn($b) => json_decode($b), $books);
        }

        $books = $this->cartRepository->getBooks($userId);
        $books->map(
            fn($b) => Redis::hset(
                "cart:{$userId}:books",
                $b->book_id,
                json_encode($b)
            )
        );

        return $books;
    }

    public function addBook(string $userId, string $bookId, int $quantity): void
    {
        $this->clearRedis($userId);

        $this->cartRepository->addBook($userId, $bookId, $quantity);
    }

    public function updateBookQuantity(
        string $userId,
        string $bookId,
        int $quantity
    ): void {
        $this->clearRedis($userId);

        $this->cartRepository->updateBookQuantity($userId, $bookId, $quantity);
    }

    public function removeBook(string $userId, string $bookId): void
    {
        $this->clearRedis($userId);

        $this->cartRepository->removeBook($userId, $bookId);
    }
}
