<?php

namespace App\Services;
use Illuminate\Http\Response;

class ResponseService implements ResponseServiceI
{
    public function send(int $status, $data, $errors): Response
    {
        return response(
            status: $status,
            content: ["status" => $status, "data" => $data, "errors" => $errors]
        );
    }
}
