<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Interactors\BookInteractorI;
use App\Services\ResponseServiceI;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function __construct(
        private BookInteractorI $bookInteractor,
        private ResponseServiceI $responseService
    ) {
    }

    public function getRandomBooks(int $pagination, int $quantity): Response
    {
        $books = $this->bookInteractor->getRandomBooks($pagination, $quantity);

        return $this->responseService->send(200, $books, null);
    }

    public function getBooksByGenre(
        string $genreId,
        int $pagination,
        int $quantity
    ): Response {
        return $this->bookInteractor->getBooksByGenre(
            $genreId,
            $pagination,
            $quantity
        );
    }

    public function getBooksByWhitelist(
        string $userId,
        int $pagination,
        int $quantity
    ): Response {
        return $this->bookInteractor->getBooksByWhitelist(
            $userId,
            $pagination,
            $quantity
        );
    }

    public function getBooksPromotionByGenre(
        string $genreId,
        int $pagination,
        int $quantity
    ): Response {
        return $this->bookInteractor->getBooksPromotionByGenre(
            $genreId,
            $pagination,
            $quantity
        );
    }

    public function getBooksByPromotion(
        int $pagination,
        int $quantity
    ): Response {
        return $this->bookInteractor->getBooksByPromotion(
            $pagination,
            $quantity
        );
    }

    public function store(BookRequest $book): Response
    {
        $book = $this->bookInteractor->create(
            $book->only("name", "price", "stock", "genres", "authors")
        );

        $status = 200;
        $data = $book;
        $errors = null;

        return $this->responseService->send($status, $data, $errors);
    }

    public function update(array $bookId, array $book): void
    {
    }

    public function delete(array $bookId): void
    {
    }
}
