<?php

namespace App\Repositories;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookGenre;
use App\Models\Promotion;
use App\Models\UserWhitelist;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookRepository implements BookRepositoryI
{
    public function getRandomBooks(int $pagination, int $quantity): Collection
    {
        $genres = Book::with("authors", "genres")
            ->orderBy(DB::raw("random()"))
            ->skip($pagination * $quantity)
            ->limit($quantity)
            ->get();

        return collect($genres);
    }

    public function getBooksByGenre(
        string $genreId,
        int $pagination,
        int $quantity
    ): Collection {
        $genres = BookGenre::query()
            ->where("id", $genreId)
            ->orderBy(DB::raw("random()"))
            ->skip($pagination * $quantity)
            ->limit($quantity)
            ->pluck("book_id")
            ->get();

        return Book::query()->whereIn("id", $genres)->get();
    }

    public function getBooksByWhitelist(
        string $userId,
        int $pagination,
        int $quantity
    ): Collection {
        $whitelists = UserWhitelist::query()
            ->with("book")
            ->orderBy(DB::raw("random()"))
            ->where("user_id", $userId)
            ->skip($pagination * $quantity)
            ->limit($quantity)
            ->get();

        return $whitelists->map(fn($w) => $w->book);
    }

    public function getBooksPromotionByGenre(
        string $genreId,
        int $pagination,
        int $quantity
    ): Collection {
        $promotions = Promotion::query()
            ->where("id", $genreId)
            ->orderBy(DB::raw("random()"))
            ->skip($pagination * $quantity)
            ->limit($quantity)
            ->pluck("book_id")
            ->get();

        // return $promotions->map(fn($p) => $p->book);
    }

    public function getBooksByPromotion(
        int $pagination,
        int $quantity
    ): Collection {
        $promotions = Promotion::query()
            ->with("book")
            ->orderBy(DB::raw("random()"))
            ->skip($pagination * $quantity)
            ->limit($quantity)
            ->get();

        // return $promotions->map(fn($p) => $p->book);
    }

    public function create(array $book): Collection
    {
        // Criação do livro
        $created = new Book($book);
        $created->save();

        // Criação dos vinculos autores e generos
        $genres = $book["genres"];
        $authors = $book["authors"];

        foreach ($genres as $genreId) {
            $genre = new BookGenre([
                "book_id" => $created->id,
                "genre_id" => $genreId,
            ]);

            $genre->save();
        }

        foreach ($authors as $authorId) {
            $author = new BookAuthor([
                "book_id" => $created->id,
                "author_id" => $authorId,
            ]);

            $author->save();
        }

        return collect($created);
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
