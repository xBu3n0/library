<?php

namespace App\Repositories;
use App\Models\Book;
use App\Models\BookGenre;
use App\Models\Promotion;
use App\Models\UserWhitelist;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookRepository implements BookRepositoryI
{
    public function getBooksByGenre(
        string $genreId,
        int $pagitation,
        int $quantity
    ): Collection {
        $genres = BookGenre::query()
            ->where("id", $genreId)
            ->orderBy(DB::raw("random()"))
            ->skip($pagitation * $quantity)
            ->limit($quantity)
            ->pluck("book_id")
            ->get();

        return Book::query()->whereIn("id", $genres)->get();
    }

    public function getBooksByWhitelist(
        string $userId,
        int $pagitation,
        int $quantity
    ): Collection {
        $whitelists = UserWhitelist::query()
            ->with("book")
            ->orderBy(DB::raw("random()"))
            ->where("user_id", $userId)
            ->skip($pagitation * $quantity)
            ->limit($quantity)
            ->get();

        return $whitelists->map(fn($w) => $w->book);
    }

    public function getBooksPromotionByGenre(
        string $genreId,
        int $pagitation,
        int $quantity
    ): Collection {
        $promotions = Promotion::query()
            ->where("id", $genreId)
            ->orderBy(DB::raw("random()"))
            ->skip($pagitation * $quantity)
            ->limit($quantity)
            ->pluck("book_id")
            ->get();

        // return $promotions->map(fn($p) => $p->book);
    }

    public function getBooksByPromotion(
        int $pagitation,
        int $quantity
    ): Collection {
        $promotions = Promotion::query()
            ->with("book")
            ->orderBy(DB::raw("random()"))
            ->skip($pagitation * $quantity)
            ->limit($quantity)
            ->get();

        // return $promotions->map(fn($p) => $p->book);
    }

    public function create(array $book): Collection
    {
        $created = new Book($book);
        $created->save();

        return $created;
    }

    public function update(array $bookId, array $book): void
    {
        Book::query()->where("id", $bookId)->update($book);
    }

    public function delete(array $bookId): void
    {
        Book::query()->where("id", $bookId)->delete();
    }
}
