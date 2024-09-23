<?php

namespace App\Http\Controllers;

use App\Interactors\CartInteractorI;
use App\Models\Book;
use App\Services\ResponseServiceI;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function __construct(
        private CartInteractorI $cartInteractor,
        private ResponseServiceI $responseService
    ) {
    }

    public function count(): Response
    {
        $user = auth()->user();

        // Interactor puxar a quantidade
        $count = $this->cartInteractor->getCount($user->id);

        $data = ["count" => $count];
        $errors = null;

        return $this->responseService->send(200, $data, $errors);
    }

    public function books(): Response
    {
        $user = auth()->user();

        $books = $this->cartInteractor->getBooks($user->id);

        $data = $books;
        $errors = null;

        return $this->responseService->send(200, $data, $errors);
    }

    public function create(Request $request): Response
    {
        $this->cartInteractor->addBook(
            bookId: $request->book_id,
            userId: auth()->user()->id,
            quantity: $request->quantity
        );

        return $this->responseService->send(200, null, null);
    }

    public function update(Book $book, Request $request): Response
    {
    }
}
