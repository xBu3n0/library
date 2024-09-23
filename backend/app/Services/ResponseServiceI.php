<?php

namespace App\Services;
use Illuminate\Http\Response;

interface ResponseServiceI
{
    public function send(int $status, array $data, array $errors): Response;
}
