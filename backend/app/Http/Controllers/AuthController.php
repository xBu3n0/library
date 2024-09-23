<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Mail\UserCreated as MailUserCreated;
use App\Models\User;
use App\Notifications\UserCreated;
use App\Services\ResponseServiceI;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct(private ResponseServiceI $responseService)
    {
    }

    public function register(CreateUserRequest $request): Response
    {
        $user = new User([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "is_admin" => true,
        ]);

        $created = $user->save();

        if ($user->save()) {
            $user->notify(
                new UserCreated("Bem vindo ao sistema {$request->name}")
            );

            Mail::to($user->email)->send(new MailUserCreated($user));
        }

        $status = $created ? 201 : 500;
        $data = auth()->user();
        $errors = $created
            ? null
            : [
                "auth" => ["An internal error occurred"],
            ];

        return $this->responseService->send($status, $data, $errors);
    }

    public function login(LoginRequest $request): Response
    {
        $isAuth = auth()->attempt($request->only("email", "password"));

        $status = $isAuth ? 200 : 404;
        $data = auth()->user();
        $errors = $isAuth
            ? null
            : [
                "email" => ["Usuário ou senha incorretos"],
                "password" => ["Usuário ou senha incorretos"],
            ];

        return $this->responseService->send($status, $data, $errors);
    }

    public function logout(): Response
    {
        auth()->logout();

        return $this->responseService->send(200, null, null);
    }

    public function isAuth(): Response
    {
        $isAuth = auth()->check();

        $status = $isAuth ? 200 : 401;
        $data = auth()->user();
        $errors = $isAuth ? null : ["auth" => ["Unauthenticated"]];

        return $this->responseService->send($status, $data, $errors);
    }
}
