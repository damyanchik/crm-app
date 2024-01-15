<?php

declare(strict_types=1);

namespace App\Events;

use App\Enum\BlockUserEnum;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class UserLogging
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __invoke(): void
    {
        if (Auth::check() && Auth::user()->block == BlockUserEnum::BLOCKED) {
            Auth::logout();
        }
    }
}
