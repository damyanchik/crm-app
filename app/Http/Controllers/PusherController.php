<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReceiveChatPusherRequest;
use App\Services\PusherService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PusherController extends Controller
{
    public function __construct(protected PusherService $pusherService)
    {
    }

    public function broadcast(Request $request): View
    {
        return view(
            'chat.broadcast',
            $this->pusherService->processMessage($request->get('message'))
        );
    }

    public function receive(ReceiveChatPusherRequest $request): View
    {
        return view('chat.receive', [
            $request->validated()
        ]);
    }
}
