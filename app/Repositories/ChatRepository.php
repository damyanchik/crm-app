<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ChatMessage;
use App\Repositories\Interfaces\ChatRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ChatRepository extends BaseRepository implements ChatRepositoryInterface
{
    public function __construct(ChatMessage $model)
    {
        parent::__construct($model);
    }

    public function getOrdered(int $page): Collection
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
                ($page - 1) * $perPage
            )
            ->limit($perPage)
            ->get();
    }
}
