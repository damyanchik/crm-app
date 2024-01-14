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

        $savedMessage = $this->saveChatMessage(
            $message,
            $user
        );

        $content = $this->prepareContent($savedMessage, $user);

        broadcast(new PusherBroadcast($content))->toOthers();

        return $content;
    }

    private function saveChatMessage(string $messageContent, object $user): ChatMessage
    {
        $message = new ChatMessage([
            'message' => $messageContent,
            'recipient' => 0,
        ]);

        $user->chatMessage()->save($message);

        return $message;
    }

    private function prepareContent(ChatMessage $message, object $user): array
    {
        return [
            'message' => $message->message,
            'time' => $message->created_at->format('Y-m-d H:i:s'),
            'name' => $user->name . ' ' . $user->surname,
            'avatar' => $user->avatar ? 'storage/' . $user->avatar : asset('images/unknown.png'),
        ];
    }
}
