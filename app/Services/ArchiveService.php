<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Models\Order;

class ArchiveService
{
    public function getAll(): object
    {
        return Order::search(request('search'))
            ->where(function ($query) {
                $query->whereIn('status', [
                    OrderStatusEnum::REJECTED['id'],
                    OrderStatusEnum::CLOSED['id'],
                ]);
            })
            ->sortBy(
                request('column') ?? 'id',
                request('order') ?? 'asc'
            )
            ->paginate(request('display'));
    }
}
