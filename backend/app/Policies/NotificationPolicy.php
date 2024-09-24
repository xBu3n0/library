<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Gate;
use Illuminate\Auth\Access\Response;

class NotificationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(
        User $user,
        DatabaseNotification $notification
    ): Response {
        return $user->id === $notification->notifiable_id
            ? Response::allow()
            : Response::deny();
    }

    public function delete(User $user, DatabaseNotification $notification): bool
    {
        return $user->id === $notification->notifiable_id
            ? Response::allow()
            : Response::deny();
    }
}
