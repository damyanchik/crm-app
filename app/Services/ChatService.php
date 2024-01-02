<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ChatService
{
    public function getAll(): Collection
    {
        return User::orderBy(
            'surname',
            'ASC'
        )->get();
    }

    public function getMessages(Request $request): Collection
    {
        $perPage = 5;

        return ChatMessage::orderBy('created_at', 'DESC')
            ->select(
                'user_id',
                'message',
                'created_at as time',
            )
            ->with('user')
            ->offset(
                ($request->input('page') - 1) * $perPage
            )
            ->limit($perPage)
            ->get();
    }
}
