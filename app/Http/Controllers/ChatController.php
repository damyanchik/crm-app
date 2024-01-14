<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ChatService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function __construct(protected ChatService $chatService)
    {
    }

    public function index(): View
    {
        return view('chat.index', [
            'users' => $this->chatService->getUsers()
        ]);
    }

    public function loadMessages(Request $request): JsonResponse
    {
        return response()->json([
            'messages' => $this->chatService->getMessages(intval($request->input('page')))
        ]);
    }
}
