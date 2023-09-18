<?php

namespace App\Services;

use App\Jobs\CreateCustomNotificationJob;

class CustomNotificationService
{
    public function notifyAllUsers(string $message)
    {
        CreateCustomNotificationJob::dispatch($message);
    }
}