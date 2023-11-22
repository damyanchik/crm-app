<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(): object
    {
        $users = User::orderBy(
            'surname',
            'ASC'
        )->get();

        return view('chat.index', [
            'users' => $users
        ]);
    }

    public function loadMessages(Request $request): object
    {
        $page = $request->input('page');
        $perPage = 5;

        $messages = ChatMessage::orderBy('created_at', 'DESC')
            ->select(
                'user_id',
                'message',
                'created_at as time',
            )
            ->with('user')
            ->offset(
                ($page - 1) * $perPage
            )
            ->limit($perPage)
            ->get();

        return response()->json([
            'messages' => $messages
        ]);
    }
}
