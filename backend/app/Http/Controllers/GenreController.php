<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use App\Services\ResponseServiceI;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct(private ResponseServiceI $responseService)
    {
    }

    public function list(GenreRequest $request)
    {
        $genre = new Genre(["name" => $request->name]);

        $genre->save();

        return $this->responseService->send(200, $genre, null);
    }
}
