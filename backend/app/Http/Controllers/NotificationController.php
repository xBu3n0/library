<?php

namespace App\Http\Controllers;

use App\Services\ResponseServiceI;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function __construct(private ResponseServiceI $responseService)
    {
    }

    public function list(): Response
    {
        $notifications = auth()->user()->notifications;

        $status = 200;
        $data = $notifications;
        $errors = null;

        return $this->responseService->send($status, $data, $errors);
    }

    public function read(DatabaseNotification $notification): Response
    {
        $notification->markAsRead();

        return $this->responseService->send(200, null, null);
    }

    public function destroy(DatabaseNotification $notification): Response
    {
        $notification->delete();

        return $this->responseService->send(200, null, null);
    }
}
