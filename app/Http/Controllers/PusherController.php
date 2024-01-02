<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Services\PusherService;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PusherController extends Controller
{
    public function __construct(protected PusherService $pusherService)
    {
    }

    public function broadcast(Request $request): View
    {
        return view('chat.broadcast', $this->pusherService->processMessage($request->get('message')));
    }

    public function receive(Request $request): View
    {
        return view('chat.receive', [
            'message' => $request->get('message'),
            'name' => $request->get('name'),
            'time' => $request->get('time'),
            'avatar' => $request->get('avatar'),
        ]);
    }
}
