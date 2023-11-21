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
        $content['message'] = $request->get('message');
        $content['time'] = date('Y-m-d H:i:s');

        $user = Auth::user();

        $message = new ChatMessage();
        $message->message = $content['message'];
        $message->recipient = 0;

        $user->chatMessage()->save($message);

        $content['name'] = $user->name.' '.$user->surname;
        $content['avatar'] = $user->avatar ? 'storage/'.$user->avatar : asset('images/unknown.png');

        broadcast(new PusherBroadcast($content))->toOthers();

        return view('chat.broadcast', [
            'message' => $content['message'],
            'time' => $content['time'],
            'avatar' => $content['avatar']
        ]);
    }

    public function receive(Request $request): object
    {
        return view('chat.receive', [
            'message' => $request->get('message'),
            'name' =>  $request->get('name'),
            'time' => $request->get('time'),
            'avatar' => $request->get('avatar')
        ]);
    }
}
