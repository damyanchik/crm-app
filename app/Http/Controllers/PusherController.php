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
        $messageContent = $request->get('message');
        $time = date('Y-m-d H:i:s');
        $user = Auth::user();

        $message = new ChatMessage();
        $message->message = $messageContent;
        $message->recipient = 0;

        $user->chatMessage()->save($message);

        $name = $user->name.' '.$user->surname;

        broadcast(new PusherBroadcast($messageContent, $name, $time))->toOthers();

        return view('chat.broadcast', [
            'message' => $messageContent,
            'time' => $time
        ]);
    }

    public function receive(Request $request): object
    {
        return view('chat.receive', [
            'message' => $request->get('message'),
            'name' =>  $request->get('name'),
            'time' => $request->get('time')
        ]);
    }
}
