<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\RoutesNotifications;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use RoutesNotifications;
    use HasApiTokens;

    protected mixed $fillable = [
        'name',
        'phone',
    ];

    protected mixed $casts = [];
}
