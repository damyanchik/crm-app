<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\PusherBroadcast;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class PusherService
{
    public function processMessage(string $message): array
    {
        $user = Auth::user();

        $content = $this->prepareContent(
            new ChatMessage([
                'message' => $message,
                'recipient' => 0,
            ]),
            $user
        );

        broadcast(new PusherBroadcast($content))->toOthers();

        return $content;
    }

    private function prepareContent(ChatMessage $message, object $user): array
    {
        $user->chatMessage()->save($message);

        return [
            'message' => $message->message,
            'time' => $message->created_at->format('Y-m-d H:i:s'),
            'name' => $user->name . ' ' . $user->surname,
            'avatar' => $user->avatar ? 'storage/' . $user->avatar : asset('images/unknown.png'),
        ];
    }
}
