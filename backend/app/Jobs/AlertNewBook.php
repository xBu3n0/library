<?php

namespace App\Jobs;

use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AlertNewBook implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $book)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();

        $users->map(fn($u) => Mail::to($u->email)->send(new UserCreated($u)));
    }
}
