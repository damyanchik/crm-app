<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\ChatRepository;
use Illuminate\Database\Eloquent\Collection;

class ChatService
{
    public function __construct(protected ChatRepository $chatRepository)
    {
    }

    public function getUsers(): Collection
    {
        return User::orderBy(
            'surname',
            'ASC'
        )->get();
    }

    public function getMessages(int $page): Collection
    {
        return $this->chatRepository->getOrdered($page);
    }
}
