<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\CustomNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCustomNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function handle()
    {
        User::query()
            ->select([
                'id'
            ])
            ->each(fn (User $user) => $user->notify(new CustomNotification($this->message)));
    }
}