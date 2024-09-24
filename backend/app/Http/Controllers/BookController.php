<?php

namespace App\Http\Controllers;

use App\Interactors\BookInteractorI;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(private BookInteractorI $bookInteractor)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function get(string $bookId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $bookId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $bookId)
    {
        //
    }
}
