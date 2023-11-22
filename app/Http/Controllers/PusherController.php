<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{
    public function broadcast(Request $request): object
    {
        $user = Auth::user();

        $message = $this->saveChatMessage(
            $request->get('message'),
            $user
        );

        $content = $this->prepareContent($message, $user);

        broadcast(
            new PusherBroadcast($content)
        )->toOthers();

        return view('chat.broadcast', $content);
    }

    public function receive(Request $request): object
    {
        return view('chat.receive', [
            'message' => $request->get('message'),
            'name' => $request->get('name'),
            'time' => $request->get('time'),
            'avatar' => $request->get('avatar'),
        ]);
    }

    private function saveChatMessage($messageContent, object $user): ChatMessage
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
