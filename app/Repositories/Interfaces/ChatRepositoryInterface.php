<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\ChatMessage;
use Illuminate\Support\Collection;

interface ChatRepositoryInterface
{
    public function __construct(ChatMessage $model);
    public function getOrdered(int $page): Collection;
}
