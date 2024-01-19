<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface ChatRepositoryInterface
{
    public function getOrdered(int $page): Collection;
}
